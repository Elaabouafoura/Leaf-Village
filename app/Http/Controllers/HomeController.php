<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\Projet;

class HomeController extends Controller
{
    public function index()
    {
        // Charger les partenaires avec leurs financements
        $partenaires = Partenaire::with('financements')->get();
            // Récupérer les 3 projets les plus récents
    $projects = Projet::orderBy('created_at', 'desc')->take(3)->get();

    return view('frontoffice.home', compact('projects', 'partenaires'));

    }
}
