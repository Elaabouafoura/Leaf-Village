<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Evenement;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Events\RealTimeNotification;
class EventController extends Controller
{
    // Afficher tous les événements
   public function index(Request $request)
{
    $query = Evenement::with('projet')->orderBy('date', 'desc');

    $filter = $request->get('filter', 'all'); // récupère le filtre du dropdown
    $today = Carbon::today();

    // Appliquer le filtre si nécessaire
    switch ($filter) {
        case 'upcoming':
            $query->where('date', '>', $today);
            break;
        case 'past':
            $query->where('date', '<', $today);
            break;
        case 'today':
            $query->whereDate('date', $today);
            break;
        case 'week':
            $query->whereBetween('date', [$today->startOfWeek(), $today->endOfWeek()]);
            break;
        case 'month':
            $query->whereMonth('date', $today->month);
            break;
        case 'all':
        default:
            // aucun filtre, récupérer tous les événements
            break;
    }

    // Pagination inchangée (3 éléments par page)
    $events = $query->paginate(3)->withQueryString();

    return view('backoffice.events.index', compact('events'));
}
    // Formulaire pour créer un événement
    public function create()
    {
        $projets = Projet::all();
        return view('backoffice.events.create', compact('projets'));
    }

    // Stocker un nouvel événement
 public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'date' => 'required|date',
        'lieu' => 'required|string|max:255',
        'description' => 'nullable|string',
        'idProjet' => 'required|exists:projets,idProjet',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
         'photo_ai_base64' => 'nullable|string', // Ajout pour image générée
         'generate_image' => 'nullable|boolean'
    ]);

    $data = $request->all();

    // Si l'utilisateur a uploadé une photo manuellement, on l'utilise
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('events', 'public');
    }    // ✅ Si on a reçu l'image générée par l'IA (base64)
    elseif ($request->filled('photo_ai_base64')) {
        $imageData = base64_decode($request->photo_ai_base64);

        // Générer un nom unique
        $imageName = 'events/generated_' . time() . '.png';
        $imagePath = public_path('storage/' . $imageName);

        // Créer le dossier si n'existe pas
        if (!file_exists(dirname($imagePath))) {
            mkdir(dirname($imagePath), 0755, true);
        }

        // Sauvegarder le fichier
        file_put_contents($imagePath, $imageData);

        // Stocker le chemin relatif dans la DB
        $data['photo'] = $imageName;
    }

    

            // ✅ Crée l'événement et récupère l'instance dans $event
    $event = Evenement::create($data);
 // ✅ Création automatique d'une notification liée à cet événement
   

    return redirect()->route('events.index')
        ->with('success', 'Événement créé avec succès et notification générée !');
} 
    // Formulaire pour éditer un événement
    public function edit(string $id)
    {
        $event = Evenement::findOrFail($id);
        $projets = Projet::all();
        return view('backoffice.events.edit', compact('event', 'projets'));
    }

 // Mettre à jour un événement
 // Mettre à jour un événement
public function update(Request $request, string $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'date' => 'required|date',
        'lieu' => 'required|string|max:255',
        'description' => 'nullable|string',
        'idProjet' => 'required|exists:projets,idProjet',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    $event = Evenement::findOrFail($id);
    $data = $request->except(['remove_photo']);

    // Gestion de la suppression de photo
    if ($request->has('remove_photo') && $request->remove_photo == '1') {
        // Supprimer l'ancienne photo si elle existe
        if ($event->photo) {
            Storage::disk('public')->delete($event->photo);
        }
        $data['photo'] = null;
    }

    // Gestion du nouvel upload de photo
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($event->photo) {
            Storage::disk('public')->delete($event->photo);
        }
        $data['photo'] = $request->file('photo')->store('events', 'public');
    }

    $event->update($data);

    return redirect()->route('events.index')
        ->with('success', 'Événement mis à jour avec succès !');
}


    // Supprimer un événement
    public function destroy(string $id)
    {
        $event = Evenement::findOrFail($id);
        // Supprimer la photo si elle existe
        if ($event->photo) {
            Storage::disk('public')->delete($event->photo);
        }
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Événement supprimé avec succès !');
    } 
    // ==================== FRONTOFFICE ==================== 
    // Méthode pour la page d'accueil - CORRIGÉE
    public function frontIndexHome()
    {
        $events = Evenement::with('projet')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        return $events;
    }
    // Méthode pour afficher les 5 dernières notifications sur le dashboard
    public function notificationsIndex()
{
    $notifications = Notification::with('evenement')
        ->orderBy('date', 'desc')
        ->take(5)
        ->get();

    return view('backoffice.home', compact('notifications'));
}

    // Page "View All" des événements - AVEC FILTRES
public function frontIndexAll(Request $request)
{
    $query = Evenement::with(['projet', 'users']);
    
    // Filtre par statut si demandé
    if ($request->has('filter')) {
        if ($request->filter === 'upcoming') {
            $query->where('date', '>=', now()->format('Y-m-d'));
        } elseif ($request->filter === 'past') {
            $query->where('date', '<', now()->format('Y-m-d'));
        }
    }
    
    $events = $query->orderBy('date', 'desc')->paginate(6);

    return view('frontoffice.events.index', compact('events'));
}
public function show($idEvenement)
{
    $event = Evenement::with('users')->findOrFail($idEvenement);
    return view('events.front.show', compact('event'));
}

    // Détail d'un événement
    public function frontShow($id)
    {
        $event = Evenement::with('projet')->findOrFail($id);
        return view('frontoffice.events.show', compact('event'));
    }
public function generateAiImage(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'lieu' => 'nullable|string',
        'date' => 'nullable|date',
    ]);

    $eventName = trim($request->nom);
    $desc = trim($request->description ?? '');
    $lieu = trim($request->lieu ?? '');
    $date = $request->date ?? null;

    $extraContext = '';
    if (!empty($lieu)) $extraContext .= "Location: {$lieu}. ";
    if (!empty($date)) $extraContext .= "Date: {$date}. ";

    $safeDesc = $desc ?: $eventName;

    $prompt = "photorealistic, high quality poster for an event called \"{$eventName}\". "
        . "{$extraContext}Description: {$safeDesc}. "
        . "Focus on atmosphere, vibrant mood, natural lighting, realistic people (adults and families), professional composition, no text or logos, wide shot, cinematic style, vivid colors, 4k resolution.";

    $negativePrompt = "blurry, text, watermark, logo, low quality, distorted faces, extra limbs, bad anatomy";

    $hfUrl = config('services.huggingface.url');
    $hfToken = config('services.huggingface.token');

    if (empty($hfUrl) || empty($hfToken)) {
        return response()->json(['error' => 'Hugging Face configuration missing.'], 500);
    }

    try {
        $payload = [
            "inputs" => $prompt,
            "options" => ["wait_for_model" => true],
            "parameters" => [
                "width" => 1024,
                "height" => 576,
                "guidance_scale" => 8.0,
                "num_inference_steps" => 40,
                "negative_prompt" => $negativePrompt
            ]
        ];

        $response = Http::withToken($hfToken)
            ->timeout(120)
            ->post($hfUrl, $payload);

        if ($response->ok() && str_contains($response->header('Content-Type', ''), 'image')) {
            $base64 = base64_encode($response->body());
            return response()->json(['image_base64' => $base64]);
        }

        $json = $response->json();
        if (isset($json['image_base64'])) {
            return response()->json(['image_base64' => $json['image_base64']]);
        } elseif (isset($json[0]['image_base64'])) {
            return response()->json(['image_base64' => $json[0]['image_base64']]);
        }

        return response()->json(['error' => 'Unexpected response from Hugging Face', 'details' => $json], 500);

    } catch (\Exception $e) {
        Log::error('AI image generation error', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'Error generating image', 'details' => $e->getMessage()], 500);
    }
}
    // Gérer la participation à un événement
    public function participate(Request $request, $idEvenement)
{
    // Pour tester sans authentification, on utilise un user fixe (id = 1)
    $user = Auth::user();
    $event = Evenement::findOrFail($idEvenement);

    // Vérifie si déjà inscrit
    if ($event->users()->where('evenement_user.idUser', $user->idUser)->exists()) {
        return redirect()->route('events.front.show', $idEvenement)
                         ->with('info', 'Cet utilisateur est déjà inscrit à cet événement.');
    }

    // Enregistre la participation
    $event->users()->attach($user->idUser, [
        'inscrit_le' => now(),
        'statut_participation' => 'inscrit'
    ]);
$notification = Notification::create([
    'message' => "un nouveau participant : {$user->nom}",
    'date' => Carbon::now(),
    'etat' => false,
    'idEvenement' => $event->idEvenement,
]);

// 🔥 SOLUTION SIMPLE : Envoie des données basiques
$notificationData = [
    'id' => $notification->idNotification,
    'message' => $notification->message,
    'date' => $notification->date->format('Y-m-d H:i:s'),
    'event_name' => $event->nom, // Utilise directement l'event
    'is_unread' => true
];

broadcast(new RealTimeNotification($notificationData));
    return redirect()->route('events.front.show', $idEvenement)
                     ->with('success', 'Inscription réussie à l’événement 🎉');
}

public function annulerParticipation($idEvenement)
{
    $user = Auth::user();
    $event = Evenement::findOrFail($idEvenement);

    // Vérifie si l'utilisateur est inscrit
    $isParticipating = $event->users()->where('evenement_user.idUser', $user->idUser)->exists();

    if (!$isParticipating) {
        return redirect()->route('events.front.show', $idEvenement)
                         ->with('info', 'Vous n’êtes pas inscrit à cet événement.');
    }

    // Supprime la participation
    $event->users()->detach($user->idUser);

   $notification = Notification::create([
    'message' => "annulation de participation : {$user->nom}",
    'date' => Carbon::now(),
    'etat' => false,
    'idEvenement' => $event->idEvenement,
]);

// 🔥 SOLUTION SIMPLE : Envoie des données basiques
$notificationData = [
    'id' => $notification->idNotification,
    'message' => $notification->message,
    'date' => $notification->date->format('Y-m-d H:i:s'),
    'event_name' => $event->nom, // Utilise directement l'event
    'is_unread' => true
];

broadcast(new RealTimeNotification($notificationData));

    return redirect()->route('events.front.show', $idEvenement)
                     ->with('success', 'Votre participation a été annulée avec succès.');
}

}