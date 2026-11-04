<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Figurine;
use Illuminate\Http\Request;

class FigurineController extends Controller
{
    public function index(Request $request)
    {
        $filtres = collect([]);
        // Recherche
        if ($request->has("recherche")) {
            $recherche = $request->recherche;
            $produits = Figurine::whereLike("nom", "%$recherche%")
                ->orWhereLike("description", "%$recherche%")
                ->get();

            // Filtre par catégorie
        } else if ($request->has("categories")) {
            $produits = Figurine::whereIn("categorie_id", $request->categories)->get();
            $filtres = collect($request->categories);

            // Tous les figurines
        } else {
            $produits = Figurine::inRandomOrder()->get();
        }

        return view("figurines.index", [
            "figurines" => $produits,
            "categories" => Categorie::all(),
            "filtres" => $filtres,
        ]);
    }

    public function adminFigurines()
    {
        return view('admin.adminFigurines', [
            'figurines' => Figurine::all(),
        ]);
    }

    public function modifierfigurinesForm($id)
    {
        $figurine = Figurine::findOrFail($id);

        return view('admin.modifierFigurines', [
            'figurine' => $figurine,
            'categories' => Categorie::all(),
        ]);
    }

    public function modifierFigurines(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:figurines,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'categorie_id' => 'required|integer|exists:categories,id',
        ]);

        $figurine = Figurine::findOrFail($data['id']);
        $figurine->nom = $data['nom'];
        $figurine->description = $data['description'] ?? null;
        $figurine->prix = $data['prix'];
        $figurine->stock = $data['stock'];
        $figurine->categorie_id = $data['categorie_id'];
        if ($request->hasFile('image_Path')) {
            $request->validate(['image_Path' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048']);
            $photoPath = $request->file('image_Path')->store('images', 'public');
            $figurine->image_Path = "storage/" . $photoPath;
        } else {
            $figurine->image_Path = $figurine->image_Path; // garde l'ancienne image
        }

        $figurine->save();

        return redirect()->route('admin.adminFigurines')->with('success', 'Figurine modifiée.');
    }

    public function ajouterFigurineForm()
    {
        return view('admin.ajouterFigurine', [
            'categories' => Categorie::all(),
        ]);
    }

    public function ajouterFigurine(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'image_Path' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'categorie_id' => 'required|integer|exists:categories,id',
        ]);

        if ($request->hasFile('image_Path')) {
            $photoPath = $request->file('image_Path')->store('images', 'public');
            $data['image_Path'] = "storage/" . $photoPath;
        }

        Figurine::create($data);

        return redirect()->route('admin.adminFigurines')->with('success', 'Figurine ajoutée.');
    }
}
