<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Fournisseur;
use App\Models\Ressource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RessourceController extends Controller
{
    public function index()
    {
        $ressources = Ressource::with(['fournisseur', 'activite'])->paginate(6);
        $fournisseurs = Fournisseur::all();
        $activites = Activite::all();

        return view('backoffice.Ressource.index', compact('ressources', 'fournisseurs', 'activites'));
    }

    /**
     * Ajouter simplement une ressource (sans analyse IA)
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nom'           => 'required|string|min:2|max:50',
        'type'          => 'required|string|max:50',
        'quantite'      => 'required|integer|min:2',
        'idActivite'    => 'required|exists:activites,idActivite',
        'idFournisseur' => 'required|exists:fournisseurs,idFournisseur',
        // validation for hidden inputs
        'material'      => 'nullable|string|max:255',
        'co2_impact'    => 'nullable|string|max:255',
        'co2_use'       => 'nullable|string|max:255',
        'co2_prod'      => 'nullable|string|max:255',
        'eco_alternative' => 'nullable|string|max:255',
        'recommended_supplier' => 'nullable|string|max:255',
    ], [
        'nom.required'      => 'Le nom de la ressource est obligatoire.',
        'nom.string'        => 'Le nom doit être une chaîne de caractères.',
        'nom.min'           => 'Le nom doit contenir au moins 2 caractères.',
        'nom.max'           => 'Le nom ne peut pas dépasser 50 caractères.',

        'type.required'     => 'Le type de la ressource est obligatoire.',
        'type.string'       => 'Le type doit être une chaîne de caractères.',
        'type.max'          => 'Le type ne peut pas dépasser 50 caractères.',

        'quantite.required' => 'La quantité est obligatoire.',
        'quantite.integer'  => 'La quantité doit être un nombre entier.',
        'quantite.min'      => 'La quantité doit être supérieure ou égale à 2.',

        'idActivite.exists' => 'L’activité sélectionnée est invalide.',
        'idFournisseur.exists' => 'Le fournisseur sélectionné est invalide.',
         'idActivite.required' => 'L’activité est obligatoire.',
        'idFournisseur.required' => 'Le fournisseurest obligatoire.',

        'material.max'      => 'Le champ Matériau ne peut pas dépasser 255 caractères.',
        'co2_impact.max'    => 'Le champ Impact CO₂ ne peut pas dépasser 255 caractères.',
        'co2_use.max'       => 'Le champ CO₂ Utilisation ne peut pas dépasser 255 caractères.',
        'co2_prod.max'      => 'Le champ CO₂ Production ne peut pas dépasser 255 caractères.',
        'eco_alternative.max' => 'Le champ Alternative écologique ne peut pas dépasser 255 caractères.',
        'recommended_supplier.max' => 'Le champ Fournisseur recommandé ne peut pas dépasser 255 caractères.',
    ]);

    try {
        Ressource::create($validated);

        return redirect()->route('ressources.index')
            ->with('success', 'Ressource ajoutée avec succès ✅');
    } catch (\Exception $e) {
        Log::error('Erreur lors de la création de ressource : ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Erreur : ' . $e->getMessage());
    }
}



    /**
     * Analyse IA via AJAX et retourne JSON complet avec co2_use / co2_prod
     */
   public function analyze(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
        ]);

        $openaiKey = config('services.openai.key');
        $openaiBase = config('services.openai.base', 'https://api.openai.com');

        if (!$openaiKey) {
            return response()->json(['error' => 'Clé OpenAI non configurée'], 500);
        }

$prompt = <<<EOT
Tu es un expert en durabilité environnementale et en chaîne d'approvisionnement, spécialisé dans les matériaux et leurs impacts écologiques. 
Analyse la ressource suivante et fournis UNIQUEMENT un JSON strict avec **six champs** : 

{
  "material": "...",             // Type de matériau principal
  "co2_impact": "...",           // Impact total sans "Utilisation + Production"
  "co2_use": "...",              // Impact CO₂ lors de l'utilisation, en kg CO₂
  "co2_prod": "...",             // Impact CO₂ pour la production, en kg CO₂
  "eco_alternative": "...",      // Suggestion concrète d'alternative plus écologique
  "recommended_supplier": "..."  // Fournisseur ou type d’entreprise durable en Tunisie
}

Ressource à analyser : 
- Nom : {$validated['nom']}

⚠️ Consignes importantes : 
1. Répond **exclusivement en JSON strict**, aucune explication.
2. Précisez le matérieau principal du nom de ressource donné
3. Co2_use et co2_prod doivent être **séparés et précis**. 
4. Donne des valeurs réalistes pour le CO₂ (en kg CO₂ ou kg CO₂/heure). 
5. Fournis une alternative écologique pratique et un fournisseur ou type d’entreprise existant en Tunisie. 

Exemple de réponse attendue : 
{
  "material": "bois",
  "co2_impact": "faible",
  "co2_use": "1.8 kg CO₂/heure",
  "co2_prod": "120 kg CO₂",
  "eco_alternative": "Utiliser du bois certifié FSC",
  "recommended_supplier": "EcoMatériaux Tunisie"
}
EOT;


        $response = Http::withToken($openaiKey)
            ->post($openaiBase . '/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [['role' => 'user', 'content' => $prompt]],
                'max_tokens' => 200,
                'temperature' => 0.2,
            ]);

        $text = $response->json('choices.0.message.content') ?? '{}';
        preg_match('/\{.*\}/s', $text, $m);
        $data = json_decode($m[0] ?? '{}', true);

        return response()->json($data);
    }

    /**
     * Mise à jour ressource + relancer analyse IA
     */
    public function update(Request $request, $id)
    {
        $ressource = Ressource::findOrFail($id);

        $validated = $request->validate([
            'nom'           => 'required|string|max:100',
            'type'          => 'required|string|max:50',
            'quantite'      => 'required|integer|min:1',
            'idActivite'    => 'nullable|exists:activites,idActivite',
            'idFournisseur' => 'nullable|exists:fournisseurs,idFournisseur',
        ]);

        try {
            $ressource->update($validated);

            // Relancer IA si clé OpenAI
            $openaiKey = config('services.openai.key');
            $openaiBase = config('services.openai.base', 'https://api.openai.com');

            if ($openaiKey) {
                $prompt = <<<EOT
Réanalyse cette ressource sans utiliser son type.
Donne UNIQUEMENT un JSON strict :
{
  "material": "...",
  "co2_impact": "...",
  "eco_alternative": "...",
  "recommended_supplier": "..."
}

Ressource :
- Nom : {$ressource->nom}
EOT;

                $response = Http::withToken($openaiKey)
                    ->post($openaiBase . '/v1/chat/completions', [
                        'model' => 'gpt-4o-mini',
                        'messages' => [
                            ['role' => 'system', 'content' => 'Tu es un expert environnemental. Réponds uniquement par JSON valide.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'max_tokens' => 250,
                        'temperature' => 0.2,
                    ]);

                $text = $response->json('choices.0.message.content') ?? '{}';
                preg_match('/\{.*\}/s', $text, $m);
                $json = json_decode($m[0] ?? '{}', true);

                $co2Use = $co2Prod = null;
                if (!empty($json['co2_impact'])) {
                    $parts = explode('+', $json['co2_impact']);
                    $co2Use = trim($parts[0] ?? '');
                    $co2Prod = trim($parts[1] ?? '');
                }

                $ressource->update([
                    'material' => $json['material'] ?? 'Inconnu',
                    'co2_impact' => $json['co2_impact'] ?? null,
                    'co2_use' => $co2Use,
                    'co2_prod' => $co2Prod,
                    'eco_alternative' => $json['eco_alternative'] ?? 'Non disponible',
                    'recommended_supplier' => $json['recommended_supplier'] ?? 'Aucune recommandation disponible',
                ]);
            }

            return redirect()->route('ressources.index')
                ->with('success', 'Ressource mise à jour et ré-analysée par IA 🌱');
        } catch (\Exception $e) {
            Log::error('Erreur update ressource : ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer ressource
     */
    public function destroy($id)
    {
        try {
            $ressource = Ressource::findOrFail($id);
            $ressource->delete();

            return redirect()->route('ressources.index')
                ->with('success', 'Ressource supprimée avec succès 🗑️');
        } catch (\Exception $e) {
            Log::error('Erreur suppression ressource : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
