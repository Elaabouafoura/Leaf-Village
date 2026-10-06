<?php

namespace App\Http\Controllers;

use App\Models\Financement;
use App\Models\Partenaire;
use App\Models\Projet;
use Illuminate\Http\Request;

class FinancementController extends Controller
{
    public function index(Request $request)
{
    $query = Financement::with(['partenaire', 'projet']);

    // Si un mot clé est saisi dans la recherche
    if ($request->filled('search')) {
        $search = $request->input('search');

        // Filtrer par nom de projet
        $query->whereHas('projet', function ($q) use ($search) {
            $q->where('nom', 'LIKE', "%{$search}%");
        });
    }

    $financements = $query->get();

    return view('backoffice.financements.index', compact('financements'));
}


    public function create()
    {
        // Récupérer partenaires et projets pour les select
        $partenaires = Partenaire::all();
        $projets = Projet::all();
        return view('backoffice.financements.create', compact('partenaires', 'projets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'idPartenaire' => 'required|exists:partenaires,idPartenaire',
            'idProjet' => 'required|exists:projets,idProjet',
        ]);

        Financement::create($request->all());

        return redirect()->route('financements.index')->with('success', 'Financement ajouté avec succès');
    }

    public function edit(Financement $financement)
    {
        $partenaires = Partenaire::all();
        $projets = Projet::all();
        return view('backoffice.financements.edit', compact('financement', 'partenaires', 'projets'));
    }

    public function update(Request $request, Financement $financement)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'idPartenaire' => 'required|exists:partenaires,idPartenaire',
            'idProjet' => 'required|exists:projets,idProjet',
        ]);

        $financement->update($request->all());

        return redirect()->route('financements.index')->with('success', 'Financement mis à jour');
    }

    public function destroy(Financement $financement)
    {
        $financement->delete();
        return redirect()->route('financements.index')->with('success', 'Financement supprimé');
    }
}
