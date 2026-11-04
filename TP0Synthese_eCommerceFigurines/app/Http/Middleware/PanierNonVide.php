<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanierNonVide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si le panier est vide
        if (empty(session("panier"))) {
            return redirect()->route("panier.index")->with("error", "Votre panier est vide. Veuillez ajouter des produits avant de passer à la caisse.");
        }
        // Laisse passer la requete

        return $next($request);
    }
}
