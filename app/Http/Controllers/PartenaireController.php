<?php
namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::all();
        return view('backoffice.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        return view('backoffice.partenaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'type' => 'required',
            'contact' => 'required',
        ]);

        Partenaire::create($request->all());
        return redirect()->route('partenaires.index')->with('success', 'Partenaire ajouté avec succès');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('backoffice.partenaires.edit', compact('partenaire'));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $request->validate([
            'nom' => 'required',
            'type' => 'required',
            'contact' => 'required',
        ]);

        $partenaire->update($request->all());
        return redirect()->route('partenaires.index')->with('success', 'Partenaire mis à jour');
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire->delete();
        return redirect()->route('partenaires.index')->with('success', 'Partenaire supprimé');
    }
    public function indexFront()
{
    // On récupère tous les partenaires avec leurs financements
    $partenaires = Partenaire::with('financements')->get();

    // On retourne la vue frontoffice
    return view('frontoffice.partenaires.index', compact('partenaires'));
}

}
