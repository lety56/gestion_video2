@extends('layouts.app')

@section('content')
<div class="container">
    <div class="video-details">
        <h1 class="video-title">{{ $video->titre }}</h1>

        <div class="video-metadata mb-4">
            @if ($video->categorie)
                <span class="badge bg-primary">{{ $video->categorie->nom_categorie }}</span>
            @endif
            @if ($video->typeOperation)
                <span class="badge bg-secondary">{{ $video->typeOperation->nom_type_operation }}</span>
            @endif
            @if ($video->pathologie)
                <span class="badge bg-info">{{ $video->pathologie->nom_pathologie }}</span>
            @endif
            @if ($video->duree)
                <span class="badge bg-dark">
                    <i class="bi bi-clock"></i> {{ $video->duree }} min
                </span>
            @endif
            @if ($video->date_enregistrement)
                <span class="badge bg-light text-dark">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::parse($video->date_enregistrement)->format('d/m/Y') }}
                </span>
            @endif
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Video Player -->
                <div class="video-player-container mb-4">
                    @if ($video->chemin_fichier)
                        <video width="640" height="480" controls>
                        <source src="{{ asset('storage/' . $video->chemin_fichier) }}" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>

                    @else
                        <p class="text-muted">Vidéo non disponible.</p>
                    @endif
                </div>

                <!-- Video Description -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Description</h5>
                    </div>
                    <div class="card-body">
                        @if($video->description)
                            <p>{{ $video->description }}</p>
                        @else
                            <p class="text-muted">Aucune description disponible.</p>
                        @endif
                    </div>
                </div>

                <!-- Share Video Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-share me-2"></i>Partager cette vidéo</h5>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="share-url" value="{{ url()->current() }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="copyShareUrl()">
                                <i class="bi bi-clipboard"></i> Copier
                            </button>
                        </div>
                        <div class="social-share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" class="btn btn-primary me-2">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($video->titre) }}" 
                               target="_blank" class="btn btn-info me-2">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($video->titre) }}" 
                               target="_blank" class="btn btn-secondary">
                                <i class="bi bi-linkedin"></i> LinkedIn
                            </a>
                                    <a href="https://wa.me/?text={{ urlencode($video->titre . ' ' . url()->current()) }}" 
                                target="_blank" class="btn btn-success">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Video Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-medical me-2"></i>Information médicale</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if($video->nom_patient)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-person me-2"></i>Patient</span>
                                    <span class="fw-bold">{{ $video->nom_patient }}</span>
                                </li>
                            @endif
                            @if($video->nom_docteur)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-person-badge me-2"></i>Docteur</span>
                                    <span class="fw-bold">{{ $video->nom_docteur }}</span>
                                </li>
                            @endif
                             @if($video->nom_intervenant)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-person-badge me-2"></i>Non des intervenants</span>
                                    <span class="fw-bold">{{ $video->nom_intervenant }}</span>
                                </li>
                            @endif
                            @if ($video->date_enregistrement)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-calendar-check me-2"></i>Date d'enregistrement</span>
                                    <span>{{ \Carbon\Carbon::parse($video->date_enregistrement)->format('d/m/Y') }}</span>
                                </li>
                            @endif
                            @if ($video->date_ajout)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-calendar-plus me-2"></i>Date d'ajout</span>
                                    <span>{{ \Carbon\Carbon::parse($video->date_ajout)->format('d/m/Y') }}</span>
                                </li>
                            @endif
                              @if ($video->date_intervenant)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-calendar-plus me-2"></i>Date d`intervention</span>
                                    <span>{{ \Carbon\Carbon::parse($video->date_intervenant)->format('d/m/Y') }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                @if ($video->est_telechargeable && $video->chemin_fichier)
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="{{ asset('storage/' . $video->chemin_fichier) }}" class="btn btn-success w-100" download>
                                <i class="bi bi-download me-2"></i>Télécharger la vidéo
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Nouveau bouton pour ajouter une vidéo -->
                @auth
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <a href="{{ route('videos.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-cloud-upload me-2"></i>Ajouter une vidéo
                        </a>
                    </div>
                </div>
                @endauth

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('videos.index') }}" class="btn btn-outline-primary flex-grow-1">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                    @if(auth()->check())
                        <a href="{{ route('videos.edit', ['video' => $video->id_video]) }}" class="btn btn-warning flex-grow-1">
                            <i class="bi bi-pencil me-1"></i>Modifier
                        </a>

                        <form action="{{ route('videos.destroy', ['video' => $video->id_video]) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')">
                                <i class="bi bi-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    var player = videojs('video-player', {
        controls: true,
        autoplay: false,
        preload: 'auto',
        fluid: false,  // désactive fluidité pour taille fixe
        playbackRates: [0.5, 1, 1.5, 2],
        width: 50,    // fixe largeur à 50px (petite vidéo)
        height: 50    // ajuste hauteur proportionnellement
    });

    function copyShareUrl() {
        const shareUrl = document.getElementById('share-url');
        shareUrl.select();
        document.execCommand('copy');
        alert('Lien copié dans le presse-papier !');
    }
});
</script>
@endpush

@push('styles')
<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
<style>
    .video-player-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .video-title { font-weight: 200; margin-bottom: 1rem; }
    .video-metadata { margin-bottom: 1.5rem; }
    .video-metadata .badge { margin-right: 0.5rem; padding: 0.5rem 0.75rem; }
    .social-share-buttons { margin-top: 1rem; }
    .stars-display { font-size: 1.5rem; }
</style>
@endpush