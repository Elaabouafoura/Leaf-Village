<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Afficher la liste des fournisseurs
     */
    public function index()
    {
        $fournisseurs = Fournisseur::paginate(5);
        return view('backoffice.Fournisseur.index', compact('fournisseurs'));
    }

    /**
     * Enregistrer un nouveau fournisseur
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'nom' => 'required|string|min:2|max:50',
        'adresse' => 'required|string|min:5|max:100',
        'contact' => 'required|email|max:50',
    ], [
        'nom.required' => 'Le nom du fournisseur est obligatoire.',
        'nom.string' => 'Le nom doit être une chaîne de caractères.',
        'nom.min' => 'Le nom doit comporter au moins 2 caractères.',
        'nom.max' => 'Le nom ne peut pas dépasser 50 caractères.',
        'adresse.required' => 'L\'adresse est obligatoire.',
        'adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
        'adresse.min' => 'L\'adresse doit comporter au moins 5 caractères.',
        'adresse.max' => 'L\'adresse ne peut pas dépasser 100 caractères.',
        'contact.required' => 'Le contact est obligatoire.',
        'contact.email' => 'Le contact doit être une adresse email valide.',
        'contact.max' => 'L\'adresse email ne peut pas dépasser 50 caractères.',
    ]);


        Fournisseur::create($validated);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès ✅');
    }

    /**
     * Mettre à jour un fournisseur
     */
    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
        ], [
            'nom.required' => 'Le nom de fournisseur est obligatoire.',
            'adresse.required'=>'adresse de fournisseur est obligatoire ',
            'contact.required'=>'contact de fournisseur est obligatoire'
            ]);

        $fournisseur->update($validated);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès ✏️');
    }

    /**
     * Supprimer un fournisseur
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès 🗑️');
    }
}
