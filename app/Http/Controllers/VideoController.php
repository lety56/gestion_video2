<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Categorie;
use App\Models\TypeOperation;
use App\Models\Pathologie;
use Illuminate\Support\Facades\Storage;
use App\Models\Commentaire;
use App\Models\Note;
use Carbon\Carbon;

class VideoController extends Controller
{

public function create()
{
    $categories = Categorie::all();
    $type_operations = TypeOperation::all(); // <- Cette ligne est nécessaire
    $pathologies = Pathologie::all();

    return view('videos.create', compact('categories', 'type_operations', 'pathologies'));
}



    
public function index(Request $request)
{
    // Récupérer tous les types d'opérations
    $type_operations = TypeOperation::all();

    // Récupérer toutes les pathologies
    $pathologies = Pathologie::all();

    // Récupérer la requête pour les vidéos
    $query = Video::with(['categorie', 'typeOperation', 'pathologie'])
        ->orderBy('date_ajout', 'desc');

    // Filtrer si besoin
    if ($request->filled('type_operation_id')) {
        $query->where('id_type_operations', $request->type_operation_id);
    }

    // Pagination
    $videos = $query->paginate(10)->appends($request->all());

    // Compter les vidéos totales (sans filtres pour stats générales)
    $videosCount = Video::count();

    // Compter les catégories totales
    $categoriesCount = Categorie::count();

    // Passer toutes les variables à la vue
    return view('videos.index', compact(
        'videos', 
        'type_operations', 
        'pathologies', 
        'videosCount',
        'categoriesCount'
    ));
}


    public function store(Request $request)
    {
        $request->validate([
            'titre'                => 'required|string|max:255',
            'description'          => 'nullable|string',
            'id_categorie'         => 'nullable|exists:categories,id_categorie',
            'new_categorie'        => 'nullable|string|max:255',
            'new_type_operation'   => 'nullable|string|max:255',
            'new_pathologie'       => 'nullable|string|max:255',
            'chemin_fichier'       => 'required|file|mimetypes:video/mp4,video/x-msvideo,video/x-matroska|max:512000',
            'nom_patient'          => 'nullable|string|max:255',
            'nom_docteur'          => 'nullable|string|max:255',
            'est_telechargeable'   => 'nullable|boolean',
            'id_type_operation'    => 'nullable|exists:type_operations,id_type_operation',
            'id_pathologie'        => 'nullable|exists:pathologies,id_pathologie',
            'duree'                => 'nullable|integer|min:0',
            'date_enregistrement'  => 'nullable|date',
            'date_ajout'           => 'nullable|date',
        ]);

        // Création dynamique des entités si nécessaire
        $categorie_id = $request->filled('new_categorie')
            ? Categorie::create([
                'nom_categorie' => $request->new_categorie,
                'description' => $request->description ?? 'Ajout automatique via vidéo',
              ])->id_categorie
            : $request->id_categorie;

        $type_operation_id = $request->filled('new_type_operation')
            ? TypeOperation::create(['nom_type_operation' => $request->new_type_operation])->id_type_operation
            : $request->id_type_operation;

        $pathologie_id = $request->filled('new_pathologie')
            ? Pathologie::create(['nom_pathologie' => $request->new_pathologie])->id_pathologie
            : $request->id_pathologie;

        $video = new Video();
        $video->titre                = $request->titre;
        $video->description          = $request->description;
        $video->id_categorie         = $categorie_id;
        $video->id_type_operations   = $type_operation_id;
        $video->id_pathologie        = $pathologie_id;
        $video->nom_patient          = $request->nom_patient;
        $video->nom_docteur          = $request->nom_docteur;
        $video->est_telechargeable   = $request->est_telechargeable ?? 0;
        $video->duree                = $request->duree ?? 0;
        $video->date_enregistrement  = $request->date_enregistrement ?? now();
        $video->date_ajout           = $request->date_ajout ?? now();

        if ($request->hasFile('chemin_fichier')) {
            $file = $request->file('chemin_fichier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('videos', $filename, 'public');
            // Store only the relative path (fix for retrieval)
            $video->chemin_fichier = $filePath;
        }

        $video->save();
// Nouveau : on redirige vers la page de cette vidéo
return redirect()->route('videos.show', ['video' => $video->id_video])
                 ->with('success', 'Vidéo ajoutée avec succès.');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'titre'                => 'required|string|max:255',
            'description'          => 'nullable|string',
            'id_categorie'         => 'required|exists:categories,id_categorie',
            'chemin_fichier'       => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/x-matroska|max:512000',
            'nom_patient'          => 'nullable|string|max:255',
            'nom_docteur'          => 'nullable|string|max:255',
            'est_telechargeable'   => 'nullable|boolean',
            'id_type_operation'    => 'required|exists:type_operations,id_type_operation',
            'id_pathologie'        => 'required|exists:pathologies,id_pathologie',
            'duree'                => 'nullable|integer|min:0',
            'date_enregistrement'  => 'nullable|date',
        ]);

        $video->update([
            'titre'              => $request->titre,
            'description'        => $request->description,
            'id_categorie'       => $request->id_categorie,
            'nom_patient'        => $request->nom_patient,
            'nom_docteur'        => $request->nom_docteur,
            'est_telechargeable' => $request->est_telechargeable ?? $video->est_telechargeable,
            'id_type_operations' => $request->id_type_operation,
            'id_pathologie'      => $request->id_pathologie,
            'duree'              => $request->duree,
            'date_enregistrement'=> $request->date_enregistrement ? Carbon::parse($request->date_enregistrement) : $video->date_enregistrement,
        ]);

        if ($request->hasFile('chemin_fichier')) {
            // Delete old file if exists
            if ($video->chemin_fichier) {
                Storage::disk('public')->delete($video->chemin_fichier);
            }
            $file = $request->file('chemin_fichier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('videos', $filename, 'public');
            // Update with new file path
            $video->chemin_fichier = $filePath;
            $video->save();
        }

        return redirect()->route('videos.index')->with('success', 'Vidéo mise à jour avec succès.');
    }

    public function show($id)
    {
        $video = Video::with(['categorie', 'typeOperation', 'pathologie'])->findOrFail($id);
        return view('videos.show', compact('video'));
    }

    public function commenter(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string',
            'auteur' => 'nullable|string|max:255',
        ]);

        Commentaire::create([
            'video_id' => $id,
            'auteur'   => $request->auteur,
            'contenu'  => $request->contenu,
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté.');
    }

    public function noter(Request $request, $id)
    {
        $request->validate([
            'valeur' => 'required|integer|between:1,5',
            'auteur' => 'nullable|string|max:255',
        ]);

        Note::create([
            'video_id' => $id,
            'valeur'   => $request->valeur,
            'auteur'   => $request->auteur,
        ]);

        return redirect()->back()->with('success', 'Merci pour votre note.');
    }

    public function destroy(Video $video)
    {
        if ($video->chemin_fichier && Storage::disk('public')->exists($video->chemin_fichier)) {
            Storage::disk('public')->delete($video->chemin_fichier);
        }

        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Vidéo supprimée avec succès.');
    }


public function edit(Request $request, $id)
{
    $video = Video::findOrFail($id);

    $categories = Categorie::all(['id_categorie', 'nom_categorie']);
    $type_operations = TypeOperation::all(['id_type_operations', 'nom_type_operation']);
    $pathologies = Pathologie::all(['id_pathologie', 'nom_pathologie']);

    // Requête pour récupérer la liste des vidéos, triée selon la sélection
    $query = Video::with(['categorie', 'typeOperation', 'pathologie']);

    switch ($request->get('sort')) {
        case 'oldest':
            $query->orderBy('date_ajout', 'asc');
            break;
        case 'title':
            $query->orderBy('titre', 'asc');
            break;
        case 'rating':
            $query->withAvg('notes', 'valeur')->orderBy('notes_avg_valeur', 'desc');
            break;
        case 'comments':
            $query->withCount('commentaires')->orderBy('commentaires_count', 'desc');
            break;
        case 'recent':
        default:
            $query->orderBy('date_ajout', 'desc');
            break;
    }

    // On récupère par exemple les 10 premières vidéos triées
    $videos = $query->paginate(10)->appends($request->all());

    return view('videos.edit', compact(
        'video',
        'categories',
        'type_operations',
        'pathologies',
        'videos' // Ajouté pour pouvoir afficher la liste triée dans la vue
    ));
}
}