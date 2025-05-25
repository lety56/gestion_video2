<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard (page d'accueil personnalisée).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    // Retourner la vue d'index directement au lieu de rediriger
    return view('welcome.index'); // Remplacez par le bon chemin de votre vue
}
}
