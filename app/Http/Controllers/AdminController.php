<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    // Exemple : récupérer les données avec tes modèles Eloquent
    $videosCount = \App\Models\Video::count();
    $categoriesCount = \App\Models\Categorie::count();
    $operationsCount = \App\Models\typeOperation::count();
    $pathologiesCount = \App\Models\Pathologie::count();

    // Passer les données à la vue
    return view('dashboard', compact('videosCount', 'categoriesCount', 'operationsCount', 'pathologiesCount'));
}
//
}
