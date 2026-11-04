<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Constantes;
use App\Services\PanierService;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CommandeController extends Controller
{
    public function checkout()
    {
        $panier = (new PanierService)->calculer();

        return view("commandes.index", [
            "items" => $panier["items"],
            "sousTotal" => $panier["sousTotal"],
            "totalTPS" => $panier["totalTPS"],
            "totalTVQ" => $panier["totalTVQ"],
            "total" => $panier["total"],
            "stripeKey" => config("services.stripe.key")
        ]);
    }

    public function payer(Request $request)
    {
        // Vérifier si le panier est vide ou non
        $panier = session()->get("panier", []);
        if (empty($panier)) {
            return response()->json(["error" => "Panier vide"], 400);
        }

        $panier = (new PanierService)->calculer();

        $sousTotal = (int) round($panier["sousTotal"] * 100);
        $totalTps = (int) round($panier["totalTPS"] * 100);
        $totalTvq = (int) round($panier["totalTVQ"] * 100);
        $total = (int) round($panier["total"] * 100);

        // Créer le PaymentIntent
        Stripe::setApiKey(config("services.stripe.secret"));

        $intent = PaymentIntent::create([
            'amount' => $total, // en sous
            'currency' => 'cad',
            'metadata' => [
                'user_id' => auth('client')->id(),
            ]
        ]);

        // Créer la commande
        $commande = new Commande();
        $commande->client_id = auth('client')->id();
        $commande->sous_total = $sousTotal;
        $commande->tps = $totalTps;
        $commande->tvq = $totalTvq;
        $commande->montant_total = $total;
        $commande->statut = "en_attente";
        $commande->stripe_payment_intent_id = $intent->id;
        $commande->save();

        // Répondre au frontend
        return response()->json(["clientSecret" => $intent->client_secret]);
    }

    public function confirmer(Request $request)
    {
        // Cette approche fonctionne pour un projet academique, mais on l'eviterait
        // en production: c'est seulment la redirection du navigateur qui determine
        // la mise a jour
        $id = $request->payment_intent;

        if ($id) {
            $commande = Commande::where("stripe_payment_intent_id", $id)->first();

            $commande->statut = "complete";
            $commande->save();

            $panier = (new PanierService)->calculer();
            foreach ($panier["items"] as $items) {
                $achat = new Achat();
                $achat->commande_id = $commande->id;
                $achat->produit_id = $items["produit"]->id;
                $achat->nom_produit = $items["produit"]->nom;
                $achat->prix_unitaire = $this->convertirEnsous($items["produit"]->prix);
                // s'assurer que l'etan n'est pas null, si il n'est pas present prendre le default dans la migration
                if ($items["produit"]->etat) {
                    $achat->etat = $items["produit"]->etat;
                }
                $achat->quantite = $items["quantite"];
                $achat->total = $this->convertirEnsous($items["totalProduit"]);
                $achat->save();
            }
        }

        session()->forget("panier");
        session()->forget("total");

        return view("commandes.confirmation");
    }

    public function historique()
    {
        $commandes = auth('client')->user()->commandes()->latest()->get();

        // $commande->achats()

        return view('commandes.historique', [
            "commandes" => $commandes
        ]);
    }

    private function convertirEnsous($montant)
    {
        return (int) round($montant * 100);
    }

    public function adminCommandes()
    {
        return view('admin.adminCommandes', [
            'commandes' => Commande::all(),
        ]);
    }

    public function modifierCommandes(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:commandes,id',
            'etat' => 'required|string',
        ]);

        $commande = Commande::findOrFail($request->id);

        // update l'etat de chaque achat dans la bonne commande
        foreach ($commande->achats as $achat) {
            $achat->etat = $data['etat'];
            $achat->save();
        }

        return redirect()->route('admin.adminCommandes')->with('success', 'Commande modifiée avec succès.');
    }

    public function modifierCommandeForm($id)
    {
        $commande = Commande::findOrFail($id);

        return view('admin.modifierCommande', [
            'commande' => $commande,
            'client' => $commande->client,
            'achats' => $commande->achats,
        ]);
    }
}
