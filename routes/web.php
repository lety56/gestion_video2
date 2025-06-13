<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TypeOperationController;
use App\Http\Controllers\PathologieController;
use App\Http\Controllers\TemplatesController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RoleController; // ← Ajoutez ceci
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DahboardController;
// ← Et ceci


Route::get('/', function() {
    return redirect('/login');
});

// Page de login
Route::get('/login', function() {
    return view('auth.login');
})->name('login');


Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::resource('catalogues', CatalogueController::class);
Route::post('/videos/{video}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');  // Cela crée toutes les routes CRUD pour les vidéos
Route::resource('videos', VideoController::class);  // Cela crée toutes les routes CRUD pour les vidéos
Route::resource('categories', CategorieController::class); 
Route::resource('type-operations', TypeOperationController::class);
Route::resource('pathologies', PathologieController::class);
Route::get('/admin', [TemplatesController::class, 'index'])->name('templates.index');
Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
Route::resource('user', UserController::class);
Route::resource('logs', LogController::class);        // Fournit logs.index, logs.create, etc.
Route::resource('user', UserController::class);      // Fournit users.create, users.store, etc.
Route::resource('storage', StorageController::class); // Fournit storage.index, etc.
Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::resource('logs', LogController::class)->only(['index']);
Route::resource('role', RoleController::class);
Route::resource('commentaires', CommentaireController::class);
Route::resource('notes',NoteController::class);
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [welcomeController::class, 'index'])->name('welcome');

// For comments
Route::get('/commentaires/create/{video_id}', [CommentaireController::class, 'create'])->name('commentaires.create');
Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
Route::get('/catalogues', [CatalogueController::class, 'index'])->name('catalogues.index');
Route::get('/notes/create/{video}', [NoteController::class, 'create'])
    ->name('notes.create');

// Supprimez toutes les routes notes.create existantes et gardez seulement :


Route::get('/language/{locale}', function ($locale) {
    // Vérifier que la langue est supportée
    if (in_array($locale, ['fr', 'en', 'ar'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    
    return redirect()->back();
})->name('language.switch');
// Pour les notes
Route::prefix('notes')->group(function() {
    // Version avec model binding (recommandée)
    Route::get('/create/{video}', [NoteController::class, 'create'])
        ->name('notes.create')
        ->middleware('auth');
        
    Route::post('/', [NoteController::class, 'store'])
        ->name('notes.store')
        ->middleware('auth');
});

// Pour les commentaires
Route::prefix('commentaires')->group(function() {
    Route::get('/create/{video}', [CommentaireController::class, 'create'])
        ->name('commentaires.create');
        
    Route::post('/', [CommentaireController::class, 'store'])
        ->name('commentaires.store');
});

// Supprimez les doublons de routes langues
Route::prefix('lang')->group(function () {
    Route::get('fr', function () {
        session(['locale' => 'fr']);
        return back();
    })->name('lang.fr');
    
    Route::get('en', function () {
        session(['locale' => 'en']);
        return back();
    })->name('lang.en');
    
    Route::get('ar', function () {
        session(['locale' => 'ar']);
        return back();
    })->name('lang.ar');
});