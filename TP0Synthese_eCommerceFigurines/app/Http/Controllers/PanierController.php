<?php

namespace App\Http\Controllers;

use App\Models\Constantes;
use App\Models\Figurine;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        // récupérer le panier dans la session (ou tableau vide)
        $panier = session()->get("panier", []);

        // récupérer tous les IDs du panier (les clés)
        $ids = array_keys($panier);

        // récupérer les produits présents dans le panier
        $produits = [];
        if (!empty($ids)) {
            $produits = Figurine::whereIn('id', $ids)->get();
        }

        // ajouter les items et calculer les montants
        $items = [];
        $sousTotal = 0;

        foreach ($produits as $produit) {
            // regarde l'id du produit dans le panier et dans le panier il y a les quantités du produit, ça va retourner la quantité du produit
            $quantite = $panier[$produit->id] ?? 0;
            // calcul le prix total du produit (quantite * prix unitaire)
            $totalProduit = $quantite * $produit->prix;
            $sousTotal += $totalProduit;

            $items[] = [
                "produit" => $produit,
                "quantite" => $quantite,
                "totalProduit" => $totalProduit,
            ];
        }

        // Mettre le total à jour dans la session
        $montants = $this->calculerMontants($sousTotal);

        session()->put("total", $montants["total"]);

        return view("panier.index", [
            "items" => $items,
            "sousTotal" => $sousTotal,
            "totalTPS" => $montants["tps"],
            "totalTVQ" => $montants["tvq"],
            "total" => $montants["total"]
        ]);
    }

    public function ajouter(Request $request)
    {
        $id = $request->id;

        Figurine::findOrFail($id);

        $panier = session()->get("panier", []);

        if (isset($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // Sauvegarder le panier à jour dans la session
        session()->put("panier", $panier);

        return redirect()->route("panier.index")
            ->with("success", "Produit ajouté au panier.");
    }

    public function supprimer($id)
    {
        $panier = session()->get("panier", []);


        // vérifier si le produit existe réellement dans le panier
        if (!isset($panier[$id])) {
            return redirect()->route("panier.index")
                ->with("error", "Le produit n'existe pas dans le panier");
        }

        // supprimer le produit du panier
        unset($panier[$id]);

        // si le panier est maintenant vide
        if (empty($panier)) {
            session()->forget("panier");
        } else {
            // sinon, mettre à jour le panier dans la session
            session()->put("panier", $panier);
        }

        return redirect()->route('panier.index')
            ->with("success", "Le produit a été retiré du panier");
    }

    public function modifier(Request $request)
    {
        $valides = $request->validate(
            [
                "action" => "required",
                "quantites" => "required|array",
            ],
            [
                "quantites.required" => "la quantité est obligatoire",

            ]
        );

        $action = $request->input("action", "rafraichir");

        if ($action === "vider") {
            session()->forget("panier");
            return redirect()->route("panier.index")
                ->with("success", "Le panier a été vidé");
        }

        // Rafraichir le panier
        $quantites = $request->input("quantites", []);

        $panier = session()->get("panier", []);

        // mettre à jour les quantités dans le panier ou enlever les items à 0
        foreach ($quantites as $id => $quantite) {
            // s'assurer d'utiliser un intiger
            $id = (int) $id;
            $quantite = (int) $quantite;
            if ($quantite <= 0) {
                unset($panier[$id]);
            } else {
                $panier[$id] = $quantite;
            }
        }
        // Sauvegarder le panier à jour dans la session
        empty($panier) ? session()->forget("panier") : session()->put("panier", $panier);

        return redirect()->route("panier.index")
            ->with("success", "Le panier a été mis à jour");
    }

    private function calculerMontants($sousTotal)
    {
        // calculer la TPS, TVQ et le total après taxes
        $totalTPS = $sousTotal * Constantes::$TPS;
        $totalTVQ = ($totalTPS + $sousTotal) * Constantes::$TVQ;
        $total = $sousTotal + $totalTPS + $totalTVQ;

        return [
            "tps" => number_format($totalTPS, 2, ","),
            "tvq" => number_format($totalTVQ, 2, ","),
            "total" => number_format($total, 2, ",")
        ];
    }
}
