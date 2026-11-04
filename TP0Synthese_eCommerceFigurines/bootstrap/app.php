<?php

use App\Http\Middleware\ClientIsAdmin;
use App\Http\Middleware\PanierNonVide;
use App\Http\Middleware\ProduitExiste;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "client.is_admin" => ClientIsAdmin::class,
            "panier.nonvide" => PanierNonVide::class,
            "produit.existe" => ProduitExiste::class,

        ]);
        // Quand on essaye de faire un checkout ou d'accéder à une zone protégée, on redirige vers la connexion.
        $middleware->redirectGuestsTo("/connexion");
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
