<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProduitExiste
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route("id");
        $panier = session("panier");
        // verifier si le produit existe reelment dans le panier
        if (!isset($panier[$id])) {
            return redirect()->route("panier.index")
                ->with("error", "Le produit n'existe pas dans le panier");
        }

        return $next($request);
    }
}
