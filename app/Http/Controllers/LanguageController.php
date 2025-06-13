<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Langues supportées
        $supportedLocales = ['fr', 'en', 'ar'];
        
        if (in_array($locale, $supportedLocales)) {
            // Stocker la langue en session
            Session::put('locale', $locale);
            
            // Changer la langue de l'application
            App::setLocale($locale);
            
            return redirect()->back()->with('success', 'Langue changée avec succès');
        }
        
        return redirect()->back()->with('error', 'Langue non supportée');
    }
}