<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // ADDED MISSING IMPORT

class CommentaireController extends Controller
{
    /**
     * Show form to create a new comment
     */
    public function create(Video $video)
    {
     
        $videoUrl = Storage::url('videos/'.$video->filename); // Now works with imported Storage
        
        return view('commentaires.create', [
            'video' => $video,
            'videoUrl' => $videoUrl
        ]);
    }
    
    // public function create(Video $video)
    // {
    //     return view('notes.create', compact('video'));
    // }
    

    public function store(Request $request, Video $video)
    {
        $validated = $request->validate([
            'contenu' => 'required|string|max:1000'
        ]);

        $video->commentaires()->create([
            'contenu' => $validated['contenu'],
            'id_utilisateur' => Auth::id()
        ]);

        return redirect()->back()
                         ->with('success', 'Commentaire ajouté avec succès!');
    }
/**
 * Display a listing of all comments.
 */
public function index()
{
    $commentaires = Commentaire::with(['user', 'video'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('commentaires.index', compact('commentaires'));
}

    /**
     * Display comments for a specific video
     */
    public function show($id_video)
    {
        $video = Video::findOrFail($id_video);
        $commentaires = Commentaire::where('id_video', $id_video)
            ->with(['user', 'video'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('commentaires.show', compact('commentaires', 'video'));
    }
}