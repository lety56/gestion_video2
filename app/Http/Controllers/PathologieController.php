<?php
namespace App\Http\Controllers;

use App\Models\Pathologie;
use Illuminate\Http\Request;

class PathologieController extends Controller
{
    // Afficher la liste des pathologies
    public function index()
    {
        $pathologies = Pathologie::all();
        return view('pathologies.index', compact('pathologies'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('pathologies.create');  // La vue pour créer une nouvelle pathologie
    }

    // Enregistrer une nouvelle pathologie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_pathologie' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Pathologie::create($validated);

        return redirect()->route('pathologies.index')->with('success', 'Pathologie ajoutée avec succès.');

    }

    // Afficher les détails d'une pathologie spécifique
    public function show($id)
    {
        $pathologie = Pathologie::findOrFail($id);
        return redirect()->route('pathologies.edit', $pathologie->id);
    }



    // Afficher le formulaire d'édition pour une pathologie spécifique
    public function edit($id)
    {
        $pathologie = Pathologie::findOrFail($id);
        return view('pathologies.edit', compact('pathologie'));
    }

    // Mettre à jour une pathologie
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_pathologie' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $pathologie = Pathologie::findOrFail($id);
        $pathologie->update($validated);

        return redirect()->route('pathologies.index')->with('success', 'Pathologie mise à jour avec succès.');
    }

    // Supprimer une pathologie
    public function destroy($id)
    {
        $pathologie = Pathologie::findOrFail($id);
        $pathologie->delete();

        return redirect()->route('pathologies.index')->with('success', 'Pathologie supprimée avec succès.');
    }
}
