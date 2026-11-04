<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Services\PanierService;
use Illuminate\Http\Request;

class ConfirmerPanier extends Controller
{
    public function confirmer(Request $request)
    {
        $panier = (new PanierService)->calculer();

        return view("commandes.confirmerPanier", [
            "items" => $panier["items"],
            "sousTotal" => $panier["sousTotal"],
            "totalTPS" => $panier["totalTPS"],
            "totalTVQ" => $panier["totalTVQ"],
            "total" => $panier["total"],
        ]);
    }
}
