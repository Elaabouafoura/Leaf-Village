<?php

namespace App\Http\Controllers;

use App\Models\EspaceVert;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class EspaceVertController extends Controller
{
    /**
     * Affiche la liste des espaces verts (Backoffice).
     */
    public function index(Request $request)
    {
        $query = EspaceVert::with('projet');

        // Recherche par nom
        if ($request->filled('search_name')) {
            $query->where('nom', 'like', '%' . $request->search_name . '%');
        }

        // Recherche par localisation
        if ($request->filled('search_location')) {
            $query->where('localisation', 'like', '%' . $request->search_location . '%');
        }

        // Pagination : 6 par page
        $espaces = $query->orderBy('created_at', 'desc')->paginate(6);
        $espaces->appends($request->all());

        // Liste des projets pour les selects dans les modals (create / edit)
        $projects = Projet::orderBy('nom')->get();

        return view('backoffice.espaces_verts.index', compact('espaces', 'projects'));
    }

    /**
     * Store (création) d'un espace vert.
     */
   public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
    'nom' => 'required|string|max:255|unique:espaces_verts,nom',
    'surface' => 'nullable|numeric|min:0|max:999999.99',
    'localisation' => 'nullable|string|max:20',
    'type' => 'nullable|string|max:20',
    'idProjet' => 'nullable|exists:projets,idProjet',
], [
    'nom.required' => 'The green space name is required.',
    'nom.unique' => 'A green space with this name already exists.',
    'nom.max' => 'The name must not exceed 255 characters.',
    'surface.numeric' => 'The surface must be a valid number.',
    'surface.min' => 'The surface cannot be negative.',
    'surface.max' => 'The surface value is too large.',
    'localisation.max' => 'The location must not exceed 20 characters.',
    'type.max' => 'The type must not exceed 20 characters.',
    'idProjet.exists' => 'The selected project does not exist.',
]);


    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please check errors below.');
    }

    try {
        $data = $request->only(['nom', 'surface', 'localisation', 'type', 'idProjet']);
        if (array_key_exists('idProjet', $data) && $data['idProjet'] === '') {
            $data['idProjet'] = null;
        }

        // Création de l'espace vert
        $espace = EspaceVert::create($data);

        // ---------- Génération synchrone du eco_score via OpenAI (POC simple) ----------
        try {
            $openaiKey = config('services.openai.key');
            $openaiBase = config('services.openai.base', 'https://api.openai.com');

            if ($openaiKey) {
$prompt = <<<EOT
Tu es un expert en écologie urbaine. Analyse l'espace vert suivant et fournis UNIQUEMENT un JSON strict avec deux champs :
- "eco_score" : un entier de 0 à 100 représentant la performance écologique globale.
- "justification" : 1 à 2 phrases courtes expliquant le score.

Données de l'espace vert :
- Nom : {$espace->nom}
- Type : {$espace->type}
- Surface (m²) : {$espace->surface}
- Localisation : {$espace->localisation}

Critères pour évaluer le score :
1. Surface : plus grande = meilleur potentiel écologique.
2. Type : parc > jardin > aire de jeux (impact écologique et biodiversité).
3. Localisation : zone naturelle ou périphérique = score plus élevé, centre urbain dense = score plus faible.
4. Accessibilité et utilité sociale implicite selon le type et la localisation.

Réponds STRICTEMENT par JSON valide, ex. :
{"eco_score": 78, "justification": "Parc de bonne surface situé en zone périphérique favorisant la biodiversité."}
EOT;

                $response = Http::withToken($openaiKey)
                    ->post($openaiBase . '/v1/chat/completions', [
                        'model' => 'gpt-4o-mini', // adapte si tu n'as pas accès : ex. 'gpt-4o' ou autre modèle texte
                        'messages' => [
                            ['role' => 'system', 'content' => 'Tu es un expert en écologie urbaine. Réponds uniquement par JSON valide.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'max_tokens' => 300,
                        'temperature' => 0.0,
                    ]);

                if ($response->successful()) {
                    $text = $response->json('choices.0.message.content') ?? $response->body();

                    if (preg_match('/\{.*\}/s', $text, $m)) {
                        $json = json_decode($m[0], true);
                        if (json_last_error() === JSON_ERROR_NONE && isset($json['eco_score'])) {
                            $espace->update([
                                'eco_score' => intval($json['eco_score']),
                                'eco_justification' => $json['justification'] ?? $text,
                            ]);
                        } else {
                            // réponse pas au format attendu => stocke la réponse brute
                            $espace->update(['eco_justification' => $text]);
                        }
                    } else {
                        // aucun JSON détecté => stocke la réponse brute
                        $espace->update(['eco_justification' => $text]);
                    }
                } else {
                    Log::error('OpenAI API error (eco score): ' . $response->body());
                    $espace->update(['eco_justification' => 'Erreur API IA: ' . substr($response->body(), 0, 250)]);
                }
            } else {
                // Pas de clé configurée
                $espace->update(['eco_justification' => 'Clé OpenAI non configurée - score non généré.']);
            }
        } catch (\Exception $e) {
            \Log::error('Erreur génération eco_score: ' . $e->getMessage());
            $espace->update(['eco_justification' => 'Erreur lors de la génération du score : ' . $e->getMessage()]);
        }
        // -------------------------------------------------------------------------------

        return redirect()->route('espaces_verts.index')
            ->with('success', 'Espace vert créé avec succès !');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
    }
}

    /**
     * Affichage d'un espace vert (redirection vers index par défaut).
     */
    public function show($id)
    {
        return redirect()->route('espaces_verts.index');
    }

    /**
     * Edit (redirection vers index si formulaire dans modal).
     */
    public function edit($id)
    {
        return redirect()->route('espaces_verts.index');
    }

    /**
     * Mise à jour d'un espace vert.
     * Note: on récupère explicitement le modèle via l'id pour éviter les problèmes de binding.
     */
    public function update(Request $request, $id)
    {
        $espace = EspaceVert::findOrFail($id);

        $validator = Validator::make($request->all(), [
    'nom' => 'required|string|max:255|unique:espaces_verts,nom',
    'surface' => 'nullable|numeric|min:0|max:999999.99',
    'localisation' => 'nullable|string|max:20',
    'type' => 'nullable|string|max:20',
    'idProjet' => 'nullable|exists:projets,idProjet',
], [
    'nom.required' => 'The green space name is required.',
    'nom.unique' => 'A green space with this name already exists.',
    'nom.max' => 'The name must not exceed 255 characters.',
    'surface.numeric' => 'The surface must be a valid number.',
    'surface.min' => 'The surface cannot be negative.',
    'surface.max' => 'The surface value is too large.',
    'localisation.max' => 'The location must not exceed 20 characters.',
    'type.max' => 'The type must not exceed 20 characters.',
    'idProjet.exists' => 'The selected project does not exist.',
]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
            ->with('edit_modal_id', $espace->idEspace); // 🔥 clé pour rouvrir le bon modal
        }

        try {
            $data = $request->only(['nom', 'surface', 'localisation', 'type', 'idProjet']);
            if (array_key_exists('idProjet', $data) && $data['idProjet'] === '') {
                $data['idProjet'] = null;
            }

            $espace->update($data);
 // ---------- Génération synchrone du eco_score via OpenAI (POC simple) ----------
        try {
            $openaiKey = config('services.openai.key');
            $openaiBase = config('services.openai.base', 'https://api.openai.com');

            if ($openaiKey) {
$prompt = <<<EOT
Tu es un expert en écologie urbaine. Analyse l'espace vert suivant et fournis UNIQUEMENT un JSON strict avec deux champs :
- "eco_score" : un entier de 0 à 100 représentant la performance écologique globale.
- "justification" : 1 à 2 phrases courtes expliquant le score.

Données de l'espace vert :
- Nom : {$espace->nom}
- Type : {$espace->type}
- Surface (m²) : {$espace->surface}
- Localisation : {$espace->localisation}

Critères pour évaluer le score :
1. Surface : plus grande = meilleur potentiel écologique.
2. Type : parc > jardin > aire de jeux (impact écologique et biodiversité).
3. Localisation : zone naturelle ou périphérique = score plus élevé, centre urbain dense = score plus faible.
4. Accessibilité et utilité sociale implicite selon le type et la localisation.

Réponds STRICTEMENT par JSON valide, ex. :
{"eco_score": 78, "justification": "Parc de bonne surface situé en zone périphérique favorisant la biodiversité."}
EOT;

                $response = Http::withToken($openaiKey)
                    ->post($openaiBase . '/v1/chat/completions', [
                        'model' => 'gpt-4o-mini', // adapte si tu n'as pas accès : ex. 'gpt-4o' ou autre modèle texte
                        'messages' => [
                            ['role' => 'system', 'content' => 'Tu es un expert en écologie urbaine. Réponds uniquement par JSON valide.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'max_tokens' => 300,
                        'temperature' => 0.0,
                    ]);

                if ($response->successful()) {
                    $text = $response->json('choices.0.message.content') ?? $response->body();

                    if (preg_match('/\{.*\}/s', $text, $m)) {
                        $json = json_decode($m[0], true);
                        if (json_last_error() === JSON_ERROR_NONE && isset($json['eco_score'])) {
                            $espace->update([
                                'eco_score' => intval($json['eco_score']),
                                'eco_justification' => $json['justification'] ?? $text,
                            ]);
                        } else {
                            // réponse pas au format attendu => stocke la réponse brute
                            $espace->update(['eco_justification' => $text]);
                        }
                    } else {
                        // aucun JSON détecté => stocke la réponse brute
                        $espace->update(['eco_justification' => $text]);
                    }
                } else {
                    \Log::error('OpenAI API error (eco score): ' . $response->body());
                    $espace->update(['eco_justification' => 'Erreur API IA: ' . substr($response->body(), 0, 250)]);
                }
            } else {
                // Pas de clé configurée
                $espace->update(['eco_justification' => 'Clé OpenAI non configurée - score non généré.']);
            }
        } catch (\Exception $e) {
            \Log::error('Erreur génération eco_score: ' . $e->getMessage());
            $espace->update(['eco_justification' => 'Erreur lors de la génération du score : ' . $e->getMessage()]);
        }
            return redirect()->route('espaces_verts.index')
                ->with('success', 'Espace vert mis à jour avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un espace vert.
     */
    public function destroy($id)
    {
        $espace = EspaceVert::findOrFail($id);

        try {
            $espace->delete();
            return redirect()->route('espaces_verts.index')
                ->with('success', 'Espace vert supprimé avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('espaces_verts.index')
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Frontoffice index (optionnel)
     */
    public function frontIndex()
    {
        $espaces = EspaceVert::with('projet')->orderBy('created_at', 'desc')->get();
        return view('frontoffice.espaces_verts.index', compact('espaces'));
    }

    /**
     * Frontoffice show (optionnel)
     */
    public function frontShow($id)
    {
        $espace = EspaceVert::with('projet')->findOrFail($id);
        return view('frontoffice.espaces_verts.show', compact('espace'));
    }
}
