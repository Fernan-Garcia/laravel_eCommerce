<?php

namespace App\Http\Controllers;


use App\Models\Categorie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexCategories()
    {
        return view('admin.adminCategories', [
            'categories' => Categorie::all(),
        ]);
    }

    public function ajouterCategorie(Request $request)
    {

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        Categorie::create($validated);

        return redirect()->route("admin.adminCategories")
            ->with("success", "Catégorie ajoutée avec succès!");
    }

    public function modifierCategories(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:categories,id'],
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $categorie = Categorie::findOrFail($validated['id']);
        $categorie->update([
            'nom' => $validated['nom'],
        ]);

        return redirect()->route("admin.adminCategories")
            ->with("success", "les categories ont été mis à jour!");
    }
}
