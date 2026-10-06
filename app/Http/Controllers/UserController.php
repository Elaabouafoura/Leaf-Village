<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
        public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'motDePasse' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',
        ], [
            'nom.required' => 'Le prénom est obligatoire.',
            'prenom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'motDePasse.required' => 'Le mot de passe est obligatoire.',
            'motDePasse.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'telephone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
        ]);

        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'motDePasse' => Hash::make($validatedData['motDePasse']),
            'role' => 'Admin',
            'telephone' => $validatedData['telephone'],
            'dateInscription' => now(),
        ]);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'motDePasse' => 'required|string',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'motDePasse.required' => 'Le mot de passe est obligatoire.',
        ]);

        // ✅ Attempt authentication using motDePasse
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['motDePasse'],
        ])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Redirect based on role
            if ($user->role === 'User') {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/signin');
    }



    public function index()
    {
        $users = User::withCount(['activites', 'evenements'])
                    ->orderBy('dateInscription', 'desc')
                    ->paginate(4);
                    
        $totalUsers = User::count();
        $activeUsers = User::count(); // You might have an 'active' field in your database
        $adminUsers = User::where('role', 'Admin')->count();
        $newUsers = User::where('dateInscription', '>=', now()->subDays(1))->count();
        
        return view('backoffice.users.index', compact(
            'users', 
            'totalUsers', 
            'activeUsers', 
            'adminUsers', 
            'newUsers'
        ));
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function showProfile()
    {
        return view('frontoffice.profile.index');
    }

    public function profileAdmin()
    {
        return view('backoffice.profile.index');
    }

        public function showResetPassword()
    {
        return view('frontoffice.profile.reset-password');
    }
    public function showResetPasswordAdmin()
    {
        return view('backoffice.profile.reset-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ],[
            'current_password.required' => 'Le mot de passe est obligatoire.',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);
        
        $user = User::find(Auth::id()); 
        
        if (!Hash::check($request->current_password, $user->motDePasse)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }
        
        $user->motDePasse = Hash::make($request->new_password);
        $user->save();
        if($user->role === "Admin")
            return redirect()->route('admin.profile')->with('success', 'Mot de passe mis à jour avec succès!');
        
        return redirect()->route('profile')->with('success', 'Mot de passe mis à jour avec succès!');
    }

        public function showForgetPassword()
    {
        return view('auth.forget-password');
    }

        public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
            'email.exists' => 'Aucun utilisateur trouvé avec cette adresse e-mail.',
            'password.required' => 'Le nouveau mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->motDePasse = Hash::make($password); // ⚠️ adapte si ton champ est "motDePasse"
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Mot de passe réinitialisé avec succès.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function sendResetLink(Request $request)
    {
        // Validation de l'email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'email.exists' => 'Aucun utilisateur trouvé avec cette adresse e-mail.',
        ]);

        // Envoi du lien
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Vérification du statut de l’envoi
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showUpdateProfile()
    {
        return view('backoffice.profile.update-profile');
    }

    public function showUpdateProfileUser()
    {
        return view('frontoffice.profile.update-profile');
    }


    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id()); 

        // 🔒 Validation
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->idUser, 'idUser')
            ],
            'telephone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'telephone')->ignore($user->idUser, 'idUser')
            ],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'telephone.unique' => 'Ce numéro est déjà utilisée.',
        ]);

        // ✅ Mise à jour des champs
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->save();
        if($user->role === "Admin")
            return redirect()->route('admin.profile')->with('success', 'Profil mis à jour avec succès ✅');

        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès ✅');
    }


}
