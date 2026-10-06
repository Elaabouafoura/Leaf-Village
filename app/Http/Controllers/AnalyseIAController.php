<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalyseIAController extends Controller
{
    public function showForm()
    {
        $projets = Projet::all();
        return view('backoffice.financements.analyser', compact('projets'));
    }

    // 🧠 Méthode appelée en AJAX
    public function analyser(Request $request)
    {
        $request->validate([
            'idProjet' => 'required|exists:projets,idProjet',
        ]);

        $projet = Projet::findOrFail($request->idProjet);

        // Données à envoyer à FastAPI
        $data = [
            'budget' => $projet->budget,
            'duration' => $projet->duree ?? 12, // valeur par défaut
            'partners' => $projet->financements->count(),
            'description' => $projet->description ?? '',
        ];

        // 🔗 Appel à FastAPI
        $response = Http::post('http://127.0.0.1:8001/analyze', $data);

        if (!$response->successful()) {
            return response()->json(['error' => 'Erreur de communication avec le serveur IA'], 500);
        }

        return response()->json($response->json());
    }
}
