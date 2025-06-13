@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Noter la vidéo</h2>
    
    <!-- Afficher la vidéo à noter -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $video->titre }}</h4>
            
            <div class="ratio ratio-16x9 mb-3">
                <video controls class="rounded" style="background-color: #000;">
                    <source src="{{ Storage::url('videos/' . $video->chemin_fichier) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
            
            <div class="video-metadata">
                <p class="text-muted mb-1">
                    <i class="bi bi-clock"></i> Durée: {{ gmdate("H:i:s", $video->duree) }}
                </p>
                <p class="card-text">{{ $video->description }}</p>
            </div>
        </div>
    </div>
    
    <!-- Formulaire de notation -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Ajouter une note</h5>
            
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="video_id" value="{{ $video->id_video }}">
                
                <div class="mb-3">
                    <label for="note" class="form-label">Note (1-5)</label>
                    <select class="form-select" id="note" name="valeur" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} - {{ $i == 1 ? 'Très mauvais' : ($i == 5 ? 'Excellent' : '') }}</option>
                        @endfor
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3" 
                              placeholder="Votre avis sur cette vidéo..."></textarea>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Soumettre la note
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .video-metadata {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }
    
    .ratio-16x9 {
        background-color: #000;
        border-radius: 8px;
        overflow: hidden;
    }
    
    video {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .form-select, textarea {
        border-radius: 8px;
    }
    
    textarea {
        min-height: 120px;
        resize: vertical;
    }
</style>
@endsection