<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ConfirmerPanier;
use App\Http\Controllers\FigurineController;
use App\Http\Controllers\ModaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;

Route::get("/", [FigurineController::class, "index"])->name("figurines.index");

Route::get("/contact", [PageController::class, "index"])->name("contact.index");

Route::get("/panier", [PanierController::class, "index"])->name("panier.index");
Route::post("/panier/ajouter/{id}", [PanierController::class, "ajouter"])->name("panier.ajouter");
Route::get("/panier/supprimer/{id}", [PanierController::class, "supprimer"])->name("panier.supprimer");
Route::post("/panier/modifier/", [PanierController::class, "modifier"])->name("panier.modifier");

// Authentification
Route::middleware('guest:client')->group(function () {
    Route::get("/inscription", [AuthController::class, "inscriptionForm"])->name("inscriptionForm");
    Route::post("/inscription", [AuthController::class, "inscription"])->name("inscription");
    Route::get("/connexion", [AuthController::class, "connexionForm"])->name("connexionForm");
    Route::post("/connexion", [AuthController::class, "connexion"])->middleware('throttle:5,1')->name("connexion");
});

// Déconnexion
Route::post("/deconnexion", [AuthController::class, "deconnexion"])->middleware('auth:client')->name("deconnexion");

// Profil
Route::middleware('auth:client')->group(function () {
    Route::get("/profil", [AuthController::class, "profilForm"])->name("profilForm");
    Route::post("/profil", [AuthController::class, "modifierProfil"])->name("modifierProfil");
    Route::post("/profil/mot-de-passe", [AuthController::class, "modifierMotDePasse"])->name("modifierMotDePasse");
});

// Admin
Route::middleware('auth:client')->middleware('client.is_admin')->group(function () {
    Route::get("/admin", [AdminController::class, "indexCategories"])->name("admin.adminCategories");
    Route::post("/admin", [AdminController::class, "modifierCategories"])->name("admin.modifierCategories");
    Route::post("/admin/ajouterCategorie", [AdminController::class, "ajouterCategorie"])->name("admin.ajouterCategorie");

    Route::get("/admin/figurines", [FigurineController::class, "adminFigurines"])->name("admin.adminFigurines");
    Route::get("/admin/figurines/modifier/{id}", [FigurineController::class, "modifierFigurinesForm"])->name("admin.modifierFigurines");
    Route::post("/admin/figurines/modifier", [FigurineController::class, "modifierFigurines"])->name("admin.modifierFigurinesPost");
    Route::get("/admin/figurines/ajouter", [FigurineController::class, "ajouterFigurineForm"])->name("admin.ajouterFigurine");
    Route::post("/admin/figurines/ajouter", [FigurineController::class, "ajouterFigurine"])->name("admin.ajouterFigurinePost");


    Route::get("/admin/commandes", [CommandeController::class, "adminCommandes"])->name("admin.adminCommandes");
    Route::post("/admin/commandes", [CommandeController::class, "modifierCommandes"])->name("admin.modifierCommandePost");
    Route::get("/admin/commandes/modifier/{id}", [CommandeController::class, "modifierCommandeForm"])->name("admin.modifierCommande");
});

// Commandes Stripe
Route::middleware('auth:client')->group(function () {
    Route::get('/checkout', [CommandeController::class, 'checkout'])->middleware("panier.nonvide")->name('commande.checkout');
    Route::post("/checkout/create", [CommandeController::class, 'payer'])->name('commande.payer');
    Route::get('/commande/confirmation', [CommandeController::class, 'confirmer'])->name('commande.confirmation');
    Route::get('/commande/annulation', [CommandeController::class, 'annuler'])->name('commande.annulation');
    // historique des commandes
    Route::get('/commandes', [CommandeController::class, 'historique'])->name('commande.historique');
    Route::get("/commande/confirmerPanier", [ConfirmerPanier::class, "confirmer"])->middleware("panier.nonvide")->name("commande.confirmerPanier");
});
