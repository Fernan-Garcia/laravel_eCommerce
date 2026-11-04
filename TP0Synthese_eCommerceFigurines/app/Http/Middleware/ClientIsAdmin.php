<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = auth('client')->user();

        // retourne erreur si le cleint n'est pas connecte ou s'il n'est pas admin
        // ne devrait pas se rende la car le bouton admin n'est pas visible pour els clients normaux
        if (!$client || !$client->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
