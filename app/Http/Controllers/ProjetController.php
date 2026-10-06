<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // ✅ Import du validateur Laravel

class ProjetController extends Controller
{
    public function index(Request $request)
    {
        $query = Projet::query();

        // Recherche par nom
        if ($request->filled('search_name')) {
            $query->where('nom', 'like', '%' . $request->search_name . '%');
        }

        // Pagination : 6 projets par page
        $projects = $query->orderBy('created_at', 'desc')->paginate(6);
        $projects->appends($request->all());

        return view('backoffice.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('backoffice.projects.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation directe avec Validator
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'budget' => 'nullable|numeric|min:0',
        ], [
            // ✅ Messages personnalisés
            'nom.required' => 'Le nom du projet est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'dateFin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'budget.numeric' => 'Le budget doit être un nombre.',
            'budget.min' => 'Le budget doit être supérieur ou égal à 0.',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Si tout est valide
        Projet::create($validator->validated());

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function show(Projet $project)
    {
        $project->load('espacesVerts');
        return view('backoffice.projects.show', compact('project'));
    }

    public function edit(Projet $project)
    {
        return view('backoffice.projects.edit', compact('project'));
    }

    public function update(Request $request, Projet $project)
    {
        // ✅ Validation directe (identique à store)
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'budget' => 'nullable|numeric|min:0',
        ], [
            'nom.required' => 'Le nom du projet est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'dateFin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'budget.numeric' => 'Le budget doit être un nombre.',
            'budget.min' => 'Le budget doit être supérieur ou égal à 0.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $project->update($validator->validated());

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

   /*  public function destroy(Projet $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    } */
public function destroy(Projet $project)
{
    $project->delete();

    // Si la requête vient d'une URL commençant par /dashboard (backoffice), 
    // rediriger vers projects.index (backoffice)
    if (request()->is('dashboard/*')) {
        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }

    // Sinon (par ex. suppression depuis front), revenir à la page précédente ou front index
    return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
}

    public function deleteConfirmation(Projet $project)
    {
        return view('backoffice.projects.delete', compact('project'));
    }

    public function frontIndex()
    {
        $projects = Projet::orderBy('created_at', 'desc')->get();
        return view('frontoffice.projects.index', compact('projects'));
    }

    public function frontShow($id)
    {
        $project = Projet::with(['espacesVerts', 'activites'])->findOrFail($id);
        return view('frontoffice.projects.show', compact('project'));
    }

    public function getProjectModal($id)
    {
        $project = Projet::with('espacesVerts')->findOrFail($id);
        return view('backoffice.projects.show', compact('project'));
    }
}
