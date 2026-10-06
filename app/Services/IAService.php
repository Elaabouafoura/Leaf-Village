<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IAService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function summarizeProjectWithDetails($project)
    {
        $financements = $project->financements->map(fn($f) =>
            "• " . $f->source . " : " . number_format($f->montant, 2) . " TND")->implode("\n");

        $espacesVerts = $project->espacesVerts->map(fn($e) =>
            "• " . $e->nom . " (" . $e->surface . " m², " . $e->type . ")")->implode("\n");

        $evenements = $project->evenements->map(fn($ev) =>
            "• " . $ev->titre . " — " . $ev->date . " à " . $ev->lieu)->implode("\n");

        $prompt = "
        Rédige un résumé professionnel et structuré du projet suivant.
        Inclure : objectifs, budget, durée, partenaires, financements, espaces verts et événements associés.

        Nom du projet : {$project->nom}
        Description : {$project->description}
        Budget : {$project->budget} $
        Date de début : {$project->dateDebut}
        Date de fin : {$project->dateFin}

        Financements :
        {$financements}

        Espaces verts :
        {$espacesVerts}

        Événements :
        {$evenements}

        Fournis un résumé clair et professionnel en français.
        ";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Tu es un expert en gestion de projets urbains et développement durable.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 500,
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'Résumé non disponible.';
    }
}
