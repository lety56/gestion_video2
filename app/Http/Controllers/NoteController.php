<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Ajout de l'import pour la classe File

class NoteController extends Controller
{
    // Dans votre contrôleur
public function index()
{
    $notes = Note::with('video', 'user')->paginate(10);
    $videos = Video::all(); // Ajoutez cette ligne
    
    return view('notes.index', compact('notes', 'videos'));
}
    
    public function create(Video $video)
    {
        return view('notes.create', compact('video'));
    }
    
 public function store(Request $request)
{
    // Validation
    $request->validate([
        'valeur' => 'required|integer|min:1|max:5',
        'commentaire' => 'nullable|string',
        'video_id' => 'required|exists:videos,id',
    ]);

    // Création de la note
    Note::create([
        'valeur' => $request->valeur,
        'commentaire' => $request->commentaire,
        'video_id' => $request->video_id,
    ]);

    // Redirection avec message flash
    return redirect()->route('notes.index')->with('success', 'Votre note a bien été enregistrée !');
}

    
    public function show($id)
    {
        $video = Video::findOrFail($id);
        
        // Vérification que le fichier existe
        $filePath = storage_path('app/public/' . $video->chemin_fichier); // Modification du chemin
        if (!File::exists($filePath)) {
            abort(404, "Le fichier vidéo n'existe pas");
        }
        
        return view('videos.show', compact('video'));
    }
}