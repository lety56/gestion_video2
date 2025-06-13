@extends('layouts.app')

@section('title', 'Tous les commentaires')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary">
                        <i class="bi bi-chat-dots-fill me-2"></i>Tous les commentaires
                    </h2>
                    <p class="text-muted">Découvrez tous les avis et commentaires sur nos vidéos</p>
                </div>
                <a href="{{ route('videos.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i>Retour aux vidéos
                </a>
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

            <!-- Statistiques -->
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    {{-- <h5 class="card-title mb-1">{{ $commentaires->total() }}</h5> --}}
                                    <p class="card-text mb-0">Commentaires total</p>
                                </div>
                                <div class="ms-3">
                                    <i class="bi bi-chat-dots display-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des commentaires -->
            @if($commentaires->count() > 0)
                <div class="row">
                    @foreach($commentaires as $commentaire)
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <!-- Informations sur la vidéo -->
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold text-primary mb-1">
                                                <i class="bi bi-play-circle me-1"></i>
                                                {{ $commentaire->video->titre ?? 'Vidéo supprimée' }}
                                            </h6>
                                            @if($commentaire->video)
                                                <p class="text-muted small mb-0">
                                                    <i class="bi bi-person-circle me-1"></i>
                                                    Dr. {{ $commentaire->video->nom_docteur ?? 'Inconnu' }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $commentaire->created_at->format('d/m/Y à H:i') }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Contenu du commentaire -->
                                    <div class="mb-3">
                                        <p class="mb-0">{{ $commentaire->commentaire }}</p>
                                    </div>

                                    <!-- Informations sur l'auteur -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 32px; height: 32px;">
                                                <i class="bi bi-person-fill text-white"></i>
                                            </div>
                                            <div>
                                                <small class="fw-semibold">
                                                    @if($commentaire->user)
                                                        {{ $commentaire->user->name }}
                                                    @else
                                                        {{ $commentaire->nom_utilisateur ?? 'Anonyme' }}
                                                    @endif
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    @if($commentaire->user)
                                                        Membre
                                                    @else
                                                        Visiteur
                                                    @endif
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="d-flex gap-2">
                                            @if($commentaire->video)
                                                <a href="{{ route('videos.show', $commentaire->video->id_video) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye me-1"></i>Voir la vidéo
                                                </a>
                                            @endif
                                            
                                            @auth
                                                @if(Auth::id() === $commentaire->id_user || Auth::user()->is_admin)
                                                    <form action="{{ route('commentaires.destroy', $commentaire->id) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash me-1"></i>Supprimer
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
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
                        <h4 class="text-muted">Aucun commentaire pour le moment</h4>
                        <p class="text-muted">Soyez le premier à commenter une vidéo !</p>
                        <a href="{{ route('videos.index') }}" class="btn btn-primary">
                            <i class="bi bi-play-circle me-1"></i>Découvrir les vidéos
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection