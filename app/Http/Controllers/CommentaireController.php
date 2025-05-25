<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // facultatif, car même namespace

class CommentaireController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        $commentaire = new Commentaire();
        $commentaire->video_id = $video->id_video;
        $commentaire->user_id = auth()->id(); // nullable si non connecté
        $commentaire->contenu = $request->contenu;
        $commentaire->save();

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }
}
