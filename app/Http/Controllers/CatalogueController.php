<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Categorie;
use App\Models\TypeOperation;
use App\Models\Pathologie;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Affiche la page du catalogue de vidéos avec filtres
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Récupérer les données pour les filtres avec les bons champs
        $categories = Categorie::orderBy('nom_categorie')->get();
        $typeOperations = TypeOperation::orderBy('nom_type_operation')->get();
        $pathologies = Pathologie::orderBy('nom_pathologie')->get();

        // Construire la requête de base avec les relations
        $query = Video::with(['categorie', 'typeOperation', 'pathologie'])
            ->select('videos.*');
        
        // Partie commentée temporairement (table 'user_favorites' absente)
        /*
        ->leftJoin('user_favorites', function ($join) {
            $join->on('videos.id', '=', 'user_favorites.video_id')
                ->where('user_favorites.user_id', auth()->id() ?: 0);
        })
        ->selectRaw('CASE WHEN user_favorites.id IS NOT NULL THEN 1 ELSE 0 END as est_favoris');
        */

        // Appliquer les filtres
        if ($request->filled('titre')) {
            $query->where('videos.titre', 'like', '%' . $request->titre . '%');
        }

        if ($request->filled('categorie_id')) {
            $query->where('videos.categorie_id', $request->categorie_id);
        }

        if ($request->filled('type_operation_id')) {
            $query->where('videos.type_operation_id', $request->type_operation_id);
        }

        if ($request->filled('pathologie_id')) {
            $query->where('videos.pathologie_id', $request->pathologie_id);
        }

        if ($request->filled('docteur')) {
            $query->where('videos.nom_docteur', 'like', '%' . $request->docteur . '%');
        }

        /*
        // Filtre sur la note moyenne désactivé
        if ($request->filled('note_min')) {
            $query->where('videos.note_moyenne', '>=', $request->note_min);
        }
        */

        if ($request->filled('date_debut')) {
            $query->whereDate('videos.date_enregistrement', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('videos.date_enregistrement', '<=', $request->date_fin);
        }

        // Gestion du tri
        $sort = $request->input('sort', 'recent');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('videos.date_enregistrement', 'asc');
                break;
            case 'title':
                $query->orderBy('videos.titre', 'asc');
                break;
            /*
            case 'rating':
                $query->orderBy('videos.note_moyenne', 'desc');
                break;
            */
            case 'comments':
                $query->orderBy('videos.nombre_commentaires', 'desc');
                break;
            default: // 'recent'
                $query->orderBy('videos.date_enregistrement', 'desc');
                break;
        }

        // Obtenir les vidéos paginées
        $videos = $query->paginate(12)->withQueryString();

        // Récupérer les vidéos recommandées (meilleures notes) désactivé
        /*
        $videosRecommandees = Video::with(['categorie'])
            ->where('note_moyenne', '>=', 4)
            ->orderBy('note_moyenne', 'desc')
            ->limit(4)
            ->get();
        */
        $videosRecommandees = collect(); // Collection vide pour éviter erreur

        // Statistiques pour les cartes en haut
        $totalVideos = Video::count();
        $totalCategories = Categorie::count();
        $totalOperations = TypeOperation::count();
        $totalPathologies = Pathologie::count();

        return view('catalogues.index', compact(
            'videos',
            'videosRecommandees',
            'categories',
            'typeOperations',
            'pathologies',
            'totalVideos',
            'totalCategories',
            'totalOperations',
            'totalPathologies'
        ));
    }
}
