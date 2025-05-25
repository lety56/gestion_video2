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
use App\Http\Controllers\CommentaireController;
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
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [welcomeController::class, 'index'])->name('welcome');


Route::get('/catalogues', [CatalogueController::class, 'index'])->name('catalogues.index');

// Protéger une route pour les administrateurs uniquement
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('role:administrateur');

// Vérifier une permission spécifique
Route::post('/videos/{video}/edit', [VideoController::class, 'update'])
    ->middleware('permission:video,modification');

use Illuminate\Support\Facades\Route;

Route::get('language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');
