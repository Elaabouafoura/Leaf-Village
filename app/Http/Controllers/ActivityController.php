<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Notification;
use App\Models\Projet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use OpenAI\Laravel\Facades\OpenAI;

class ActivityController extends Controller
{
        public function index(Request $request)
    {
        // Fetch activities with related project & member
        $query = Activite::with('projet');
        $projects   = Projet::all();
        $members    = User::all();
            // 🔍 Recherche par nom
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // 🧭 Filtrage par projet
        if ($request->filled('project_id')) {
            $query->where('idProjet', $request->project_id);
        }

        // 📄 Pagination (10 activités par page)
        $activities = $query->paginate(1);
        return view('backoffice.activities.index', compact('activities', 'projects', 'members'));
    }

    
        public function indexFront()
    {
        $user = Auth::user();

        // Récupère les activités dont l'utilisateur participe à l'événement lié
        $activities = Activite::whereHas('members', function ($query) use ($user) {
            $query->where('activite_user.idUser', $user->idUser);
        })
        ->with(['projet', 'feedbacks.user'])
        ->get();

        return view('frontoffice.activities.index', compact('activities'));
    }
    public function create()
    {
        return view('backoffice.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'idProjet' => 'exists:projets,idProjet',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:users,idUser',
            'date' => 'nullable|date'
        ]);

        // Create activity
        $activity = Activite::create($request->only(['nom', 'description', 'idProjet', 'date']));

        // Attach members if provided
        if ($request->filled('member_ids')) {
            $activity->members()->sync($request->member_ids);
        }

        return redirect()->route('activities.index')->with('success', 'Activité créée avec succès 🌱');
    }

    

    public function show($id)
    {
        $activity = Activite::with(['projet', 'members', 'feedbacks', 'ressources.fournisseur'])->findOrFail($id);
        if(count($activity->feedbacks)>2){
            $feedbacks = $activity->feedbacks->map(fn($f) => [
                'commentaire' => $f->commentaire,
                'note' => (int) $f->note,
            ])->toArray();
                
            $feedbackAnalysis =$this->analyzeFeedbacks($feedbacks) ;
            $feedbackAnalysis = $feedbackAnalysis->getData(true);
        }
        else{
          $feedbackAnalysis = []  ;
        }
         // Convertir JsonResponse -> array


        return view('backoffice.activities.show', compact('activity','feedbackAnalysis'));
    }

    public function edit(Activite $activite)
    {
        return view('backoffice.activities.edit', compact('activite'));
    }

    public function update(Request $request, Activite $activity)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'idProjet' => 'exists:projets,idProjet'
        ]);

        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Activité mise à jour avec succès ✨');
    }

    public function destroy(Activite $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activité supprimée ✅');
    }

    // Gérer la participation à un événement
    public function participate(Request $request, $idActivite)
    {
        // Pour tester sans authentification, on utilise un user fixe (id = 1)
        $user = Auth::user();
        $activite = Activite::findOrFail($idActivite);

        // Vérifie si déjà inscrit
        if ($activite->members()->where('activite_user.idUser', $user->idUser)->exists()) {
            return redirect()->route('activities.front.index')
                            ->with('info', 'Cet utilisateur est déjà inscrit à cette activité.');
        }

        // Enregistre la participation
        $activite->members()->attach($user);
/*         Notification::create([
                'message' => "un nouveau participant : {$user->nom}",
                'date' => Carbon::now(),
                'etat' => false, // false = non lue
                'idEvenement' => $event->idEvenement,
            ]); */
        return redirect()->route('activities.front.index')
                        ->with('success', 'Inscription réussie à l’événement 🎉');
    }


    public function annulerParticipation($idActivite)
    {
        $user = Auth::user();
        $event = Activite::findOrFail($idActivite);

        // Vérifie si l'utilisateur est inscrit
        $isParticipating = $event->members()->where('activite_user.idUser', $user->idUser)->exists();

        if (!$isParticipating) {
            return redirect()->route('activities.front.index')
                            ->with('info', 'Vous n’êtes pas inscrit à cette activité.');
        }

        // Supprime la participation
        $event->members()->detach($user->idUser);

        // (Optionnel) Créer une notification pour l’organisateur
/*         Notification::create([
            'message' => "{$user->nom} a annulé sa participation à l’événement « {$event->titre} ».",
            'date' => Carbon::now(),
            'etat' => false,
            'idActivite' => $event->idEvenement,
        ]); */

        return redirect()->route('activities.front.index')
                        ->with('success', 'Votre participation a été annulée avec succès.');
    }



    public function analyzeFeedbacks($feedbacks)
    {
        $prompt = <<<PROMPT
        You are an assistant that analyzes activity feedbacks and provides *concrete and actionable recommendations*.  
        Each feedback has a "commentaire" (string) and a "note" (numeric rating from 1 to 5).  

        You must return a **valid JSON object only** (no markdown) with the following structure:

        1. "meanRating" → average of all notes (rounded to 2 decimals)
        2. "positivePercentage" → percentage of notes >= 4
        3. "category" → qualitative evaluation:
        - "excellent" if meanRating >= 4.0
        - "average" if meanRating >= 3.0 and < 4.0
        - "poor" if meanRating < 3.0
        4. "mainMessage" → a one-sentence summary of the overall feedback tone:
        - "Excellent travail ! Continuez sur cette lancée 🌟" (excellent)
        - "Des améliorations sont possibles 📈" (average)
        - "Une attention particulière est nécessaire ⚠️" (poor)
        5. "recommendations" → a list of **specific and practical recommendations** (3 to 5 max), tailored to the feedbacks:
        - Always include at least one suggestion directly inspired by the most common negative comments.
        - Use action verbs and be precise (e.g., “Renforcer la communication avec les participants”, “Améliorer la qualité du support technique”, “Mieux répartir les tâches dans l’équipe”).
        - If positivePercentage < 70 → include a general recommendation to improve satisfaction (e.g., “Identifier les causes principales d’insatisfaction et les corriger avant la prochaine activité.”)
        - Always include:
            - “Analyser les commentaires pour identifier les tendances clés.”
            - “Planifier et suivre la mise en œuvre des actions correctives.”
        6. "topKeywords" → the 5 most frequent or meaningful keywords extracted from the comments.

        Return only valid JSON without any explanation.

        Here are the feedbacks to analyze:
        PROMPT;


        // Convert feedbacks array to JSON for the model
        $feedbacksJson = json_encode($feedbacks, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini', // or gpt-4o, gpt-3.5-turbo, etc.
            'messages' => [
                ['role' => 'system', 'content' => 'You are a professional feedback analysis assistant.'],
                ['role' => 'user', 'content' => $prompt . "\n" . $feedbacksJson],
            ],
            'temperature' => 0.3,
        ]);

        // Decode clean JSON from response
        $content = $response['choices'][0]['message']['content'];
        $data = json_decode($content, true);

        // Handle invalid JSON or decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON returned from model', 'raw' => $content], 500);
        }

        return response()->json($data);
    }

        public function export()
       {
         $activities = Activite::with(['projet', 'members'])->get();

    $fileName = 'activities_complete_' . date('Y-m-d_H-i-s') . '.csv';
$filePath = storage_path('app/exports/' . $fileName);
    
    // Ensure directory exists
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }
    
    $handle = fopen($filePath, 'w');
    fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM
    
    // Headers
    fputcsv($handle, [
        'ID', 'Nom', 'Description', 'Projet', 'Membres', 'Date', 
        'Date de création', 'Date de modification'
    ], ';');
    
    // Data
    foreach ($activities as $activity) {
        $members = $activity->members->pluck('nom')->implode(', ');
        
        fputcsv($handle, [
            $activity->idActivite,
            $activity->nom,
            $activity->description,
            $activity->projet ? $activity->projet->nom : 'Aucun projet',
            $members ?: 'Aucun membre',
            $activity->date ? $activity->date->format('d/m/Y') : 'Non définie',
            $activity->created_at->format('d/m/Y H:i'),
            $activity->updated_at->format('d/m/Y H:i')
        ], ';');
    }
    
    fclose($handle);
    
    // Download the file AND keep a copy on server
    return response()->download($filePath)->deleteFileAfterSend(true);
    }

}
