<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Category;  // Utilisation du modèle Category (au singulier)
use App\Models\Video;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();  // Utilisation de Category
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Categorie::all();  // Utilisation de Category
        $videos = Video::all();
        return view('categories.create', compact('categories', 'videos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id_categorie',
            'video_id' => 'nullable|exists:videos,id_video',
        ]);

        $categorie = Categorie::create([  // Utilisation de Category
            'nom_categorie' => $validated['nom_categorie'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'] ?? null,
            'video_id' => $validated['video_id'] ?? null,
        ]);

        return redirect()->route('categories.show', $categorie->id_categorie)
                         ->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function show($id)
    {
        $categorie = Categorie::with('parent', 'videos')->findOrFail($id);  // Utilisation de Category
        return view('categories.show', compact('categorie'));
    }

public function edit($id)
{
    $categorie = Categorie::find($id);

    if (!$categorie) {
        abort(404);  // catégorie non trouvée
    }

    $categories = Categorie::where('id_categorie', '!=', $id)->get(); // toutes sauf la catégorie actuelle
    $videos = Video::all();

    return view('categories.edit', compact('categorie', 'categories', 'videos'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categorie = Categorie::findOrFail($id);  // Utilisation de Category
        $categorie->update($request->only(['nom_categorie', 'description', 'parent_id', 'video_id']));

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);  // Utilisation de Category
        $categorie->delete();

        return redirect()->route('categories.index');
    }
}
