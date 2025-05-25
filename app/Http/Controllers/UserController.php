<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        // Formulaire de création utilisateur
        return view('users.create'); // Crée cette vue ensuite
    }
}
