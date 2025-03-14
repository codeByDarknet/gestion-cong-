<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.connexion');
    }

    /**
     * Gère la tentative de connexion de l'utilisateur.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        // Validation des credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'password.required' => 'Le mot de passe est obligatoire.'
        ]);



        // Vérification des identifiants
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Adresse e-mail ou mot de passe incorrect.']);
        }



        // Tentative d'authentification
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Régénération de la session pour éviter les fixations de session
            $request->session()->regenerate();

            // Redirection basée sur le rôle de l'utilisateur
            return $this->redirectBasedOnRole($request->user());
        }

        // Gestion de l'échec de connexion avec le message approprié identidifant ou mot de passe incorrect
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Redirige l'utilisateur vers le bon tableau de bord selon son rôle.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnRole($user)
    {
        return match($user->role->nom) {
            'employé' => redirect()->route('employe.accueil'),
            'responsable' => redirect()->route('responsable.dashboard'),
            'GRH' => redirect()->route('grh.dashboard'),
            default => redirect()->route('home'),
        };
    }

    /**
     * Déconnecte l'utilisateur.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Personnalise le champ de connexion.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
