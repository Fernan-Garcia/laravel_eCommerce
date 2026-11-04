<?php

namespace App\Services;

use App\Models\Constantes;
use App\Models\Figurine;

class PanierService
{
    public function calculer()
    {
        $panier = session()->get("panier", []);

        $ids = array_keys($panier);

        $produits = [];
        if (!empty($ids)) {
            $produits = Figurine::whereIn('id', $ids)->get();
        }

        $items = [];
        $sousTotal = 0;

        foreach ($produits as $produit) {

            $quantite = $panier[$produit->id] ?? 0;

            $totalProduit = $quantite * $produit->prix;
            $sousTotal += $totalProduit;

            $items[] = [
                "produit" => $produit,
                "quantite" => $quantite,
                "totalProduit" => $totalProduit
            ];
        }

        $montants = $this->calculerMontants($sousTotal);

        session()->put("total", $montants["total"]);

        return [
            "items" => $items,
            "sousTotal" => $sousTotal,
            "totalTPS" => $montants["tps"],
            "totalTVQ" => $montants["tvq"],
            "total" => $montants["total"],
        ];
    }

    private function calculerMontants($sousTotal)
    {
        // calculer la TPS, TVQ et le toal apres taxes
        $totalTPS = $sousTotal * Constantes::$TPS;
        $totalTVQ = ($totalTPS + $sousTotal) * Constantes::$TVQ;
        $total = $sousTotal + $totalTPS + $totalTVQ;

        return [
            "tps" => $totalTPS,
            "tvq" => $totalTVQ,
            "total" => $total
        ];
    }
}
