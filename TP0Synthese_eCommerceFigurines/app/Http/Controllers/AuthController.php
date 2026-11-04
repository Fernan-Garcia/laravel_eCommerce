<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     *
     * @return view
     */
    public function inscriptionForm()
    {
        return view('auth.register');
    }

    /**
     * Traite le formulaire d'inscription
     *
     * @param RegisterRequest $request
     * @return Redirect
     */
    public function inscription(RegisterRequest $request)
    {
        $donnees = $request->validated();

        $client = new Client();
        $client->email = $donnees["email"];
        $client->nom = $donnees["nom"];
        $client->prenom = $donnees["prenom"];
        $client->password = Hash::make($donnees["password"]);
        $client->adresse = $donnees["adresse"];
        $client->ville = $donnees["ville"];
        $client->codePostal = $donnees["codePostal"];
        $client->province = $donnees["province"];
        $client->telephone = $donnees["telephone"];


        $client->save();


        Auth::guard('client')->login($client);

        return redirect()->route("profilForm")
            ->with("success", "Votre compte a été créé! Bon magasinage!");
    }

    /**
     * Affiche le formulaire de connexion
     *
     * @return View
     */
    public function connexionForm()
    {
        return view('auth.login');
    }

    public function connexion(LoginRequest $request)
    {
        $donnees = $request->validated();

        if (Auth::guard('client')->attempt($donnees)) {
            $request->session()->regenerate();
            return redirect()->intended(route("figurines.index"))
                ->with("success", "Vous êtes connecté!");
        }

        return back()->withErrors([
            "email" => "Le courriel ou le mot de passe est invalide."
        ]);
    }

    public function deconnexion(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("figurines.index")
            ->with('success', "Vous avez été déconnecté.");
    }

    public function profilForm()
    {
        return view("auth.profil");
    }

    public function modifierProfil(Request $request)
    {
        $client = Auth::guard('client')->user();

        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "adresse" => "required",
            "ville" => "required",
            "codePostal" => "required",
            "province" => "required",
            "telephone" => "required"
        ]);
        // chatGPT m'ai aidé, car je ne trouvais pas comment mettre a jour les champs
        $client->update($request->only([
            "nom",
            "prenom",
            "adresse",
            "ville",
            "codePostal",
            "province",
            "telephone"
        ]));

        return redirect()->route("profilForm")
            ->with("success", "Votre profil a été mis à jour!");
    }

    public function modifierMotDePasse(Request $request)
    {
        $client = Auth::guard('client')->user();

        $request->validate([
            "password" => "required", // current password
            "new_password" => "required|confirmed|min:8"
        ]);


        // verifier le mot de passe actuel
        if (!Hash::check($request->password, $client->password)) {
            return back()->withErrors([
                "password" => "Le mot de passe actuel est incorrect."
            ]);
        }

        // verifier que le nouveau mot de passe est différent de l'ancien
        if (Hash::check($request->new_password, $client->password)) {
            return back()->withErrors([
                "new_password" => "Le nouveau mot de passe doit être différent de l'ancien."
            ]);
        } else {
            // mettre à jour le mot de passe
            $client->password = Hash::make($request->new_password);
            $client->save();

            return redirect()->route("figurines.index")
                ->with("success", "Votre mot de passe a été mis à jour!");
        }
    }
}
