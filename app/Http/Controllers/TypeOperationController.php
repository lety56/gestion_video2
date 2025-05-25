<?php

namespace App\Http\Controllers;

use App\Models\TypeOperation;
use Illuminate\Http\Request;

class TypeOperationController extends Controller
{
    public function index()
    {
        $types = TypeOperation::all();
        return view('type-operations.index', compact('types'));
    }

    public function create()
    {
        return view('type-operations.create');
    }

    public function store(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'nom_type_operation' => 'required|string|max:255',  // Validation du nom
            'description' => 'nullable|string',
        ]);

        // Ajout du type d'opération à la base de données
        TypeOperation::create($validated);
    
        return redirect()->route('type-operations.index')->with('success', 'Type d\'opération ajouté avec succès.');
    }
    public function show($id)
    {
        // Récupérer le type d'opération
        $typeOperation = TypeOperation::findOrFail($id);
    
        // Rediriger vers la page d'édition avec l'id
        return redirect()->route('type-operations.edit', $typeOperation->id);
    }
    
    public function edit($id)
    {
        $type = TypeOperation::findOrFail($id);
        return view('type-operations.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_type_operation' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $type = TypeOperation::findOrFail($id);
        $type->update($validated);

        return redirect()->route('type-operations.index')->with('success', 'Mise à jour réussie.');
    }

    public function destroy($id)
    {
        $type = TypeOperation::findOrFail($id);
        $type->delete();

        return redirect()->route('type-operations.index')->with('success', 'Supprimé avec succès.');
    }
}
