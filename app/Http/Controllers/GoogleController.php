<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Vérifie si l'utilisateur existe déjà
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'nom' => $googleUser->getName(),
                    'prenom' => '',
                    'email' => $googleUser->getEmail(),
                    'motDePasse' => Hash::make(uniqid()), // mot de passe aléatoire
                    'role' => 'User', // par défaut un utilisateur standard
                    'telephone' => null,
                    'dateInscription' => now(),
                ]);
            }

            Auth::login($user);

            // 🔑 Redirection selon le rôle
            if ($user->role === 'Admin') {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/'); // Frontoffice pour les utilisateurs standard

        } catch (Exception $e) {
            return redirect('/signin')->withErrors(['error' => 'Erreur lors de la connexion Google']);
        }
    }
}
