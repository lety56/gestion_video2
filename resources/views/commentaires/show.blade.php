@extends('layouts.app')

@section('title', 'Commentaires - ' . $video->titre)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary">
                        <i class="bi bi-chat-dots-fill me-2"></i>Commentaires
                    </h2>
                    <p class="text-muted mb-0">{{ $video->titre }}</p>
                    <small class="text-muted">
                        <i class="bi bi-person-circle me-1"></i>Dr. {{ $video->nom_docteur ?? 'Inconnu' }}
                    </small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('commentaires.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-list me-1"></i>Tous les commentaires
                    </a>
                    <a href="{{ route('videos.show', $video->id_video) }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-1"></i>Retour à la vidéo
                    </a>
                </div>
            </div>

            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Informations sur la vidéo -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="fw-bold mb-2">{{ $video->titre }}</h5>
                            <p class="text-muted mb-2">{{ $video->description ?? 'Aucune description disponible' }}</p>
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                Publié le {{ $video->created_at->format('d/m/Y') }}
                            </small>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-primary text-white rounded p-3">
                                <h4 class="mb-0">{{ $commentaires->total() }}</h4>
                                <small>Commentaire{{ $commentaires->total() > 1 ? 's' : '' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des commentaires -->
            @if($commentaires->count() > 0)
                <div class="row">
                    @foreach($commentaires as $commentaire)
                        <div class="col-12 mb-3">
                            <div class="card border-start border-4 border-primary">
                                <div class="card-body">
                                    <!-- En-tête du commentaire -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0">
                                                    @if($commentaire->user)
                                                        {{ $commentaire->user->name }}
                                                    @else
                                                        {{ $commentaire->nom_utilisateur ?? 'Anonyme' }}
                                                    @endif
                                                </h6>
                                                <small class="text-muted">
                                                    @if($commentaire->user)
                                                        <span class="badge bg-primary">Membre</span>
                                                    @else
                                                        <span class="badge bg-secondary">Visiteur</span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $commentaire->created_at->format('d/m/Y à H:i') }}
                                            </small>
                                            @auth
                                                @if(Auth::id() === $commentaire->id_user || Auth::user()->is_admin)
                                                    <div class="mt-1">
                                                        <form action="{{ route('commentaires.destroy', $commentaire->id) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>

                                    <!-- Contenu du commentaire -->
                                    <div class="ps-5">
                                        <p class="mb-0">{{ $commentaire->commentaire }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $commentaires->links() }}
                </div>
            @else
                <!-- Message si aucun commentaire -->
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i class="bi bi-chat-dots display-1 text-muted mb-3"></i>
                        <h4 class="text-muted">Aucun commentaire sur cette vidéo</h4>
                        <p class="text-muted">Soyez le premier à donner votre avis !</p>
                        <a href="{{ route('videos.show', $video->id_video) }}" class="btn btn-primary">
                            <i class="bi bi-chat-plus me-1"></i>Ajouter un commentaire
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection