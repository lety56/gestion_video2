@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- En-tête avec gradient -->
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-primary mb-3">
                    <i class="fas fa-comment-alt me-2"></i>
                    Ajouter un commentaire
                </h2>
                <div class="bg-gradient-primary" style="height: 4px; width: 80px; margin: 0 auto; border-radius: 2px;"></div>
            </div>
           
            <!-- Carte vidéo -->
            @if(isset($video))
            <div class="card shadow-lg border-0 mb-5 overflow-hidden">
                <div class="card-header bg-gradient text-white py-3">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-play-circle me-2"></i>
                        {{ $video->titre }}
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="video-container position-relative">
                        <video 
                            class="w-100" 
                            style="max-height: 400px; object-fit: cover;" 
                            controls 
                            preload="metadata"
                            poster="{{ asset('images/video-placeholder.jpg') }}"
                        >
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            <div class="alert alert-warning m-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </div>
                        </video>
                        <!-- Overlay de contrôle personnalisé -->
                        <div class="video-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3); opacity: 0; transition: all 0.3s ease;">
                            <i class="fas fa-play text-white" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif
           
            <!-- Formulaire de commentaire -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <form action="{{ route('commentaires.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                       
                        <div class="mb-4">
                            <label for="contenu" class="form-label fw-semibold text-dark mb-3">
                                <i class="fas fa-pen me-2 text-primary"></i>
                                Partagez votre avis sur cette vidéo
                            </label>
                            <div class="position-relative">
                                <textarea 
                                    class="form-control form-control-lg border-2" 
                                    id="contenu" 
                                    name="contenu" 
                                    rows="4" 
                                    required 
                                    placeholder="Écrivez votre commentaire ici... Que pensez-vous de cette vidéo ?"
                                    style="resize: vertical; min-height: 120px; border-color: #e3e6f0; transition: all 0.3s ease;"
                                ></textarea>
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    Veuillez saisir votre commentaire.
                                </div>
                                <!-- Compteur de caractères -->
                                <small class="text-muted position-absolute" style="bottom: 10px; right: 15px;">
                                    <span id="charCount">0</span>/500 caractères
                                </small>
                            </div>
                        </div>
                       
                        <!-- Boutons d'action -->
                        <div class="d-flex gap-3 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="history.back()">
                                <i class="fas fa-arrow-left me-2"></i>
                                Retour
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i>
                                Publier le commentaire
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Message d'encouragement -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-heart text-danger me-1"></i>
                    Votre avis compte ! Partagez vos impressions avec la communauté.
                </small>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card {
        border-radius: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #5a6fd8 0%, #6a4190 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }
    
    .video-container:hover .video-overlay {
        opacity: 1;
    }
    
    .text-primary {
        color: #667eea !important;
    }
    
    .form-control {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-control:hover {
        border-color: #b8c6f0;
    }
    
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 2rem 1.5rem;
        }
        
        .d-flex.gap-3 {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire
    const forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    
    // Compteur de caractères
    const textarea = document.getElementById('contenu');
    const charCount = document.getElementById('charCount');
    const maxLength = 500;
    
    textarea.addEventListener('input', function() {
        const currentLength = this.value.length;
        charCount.textContent = currentLength;
        
        if (currentLength > maxLength * 0.9) {
            charCount.style.color = '#dc3545';
        } else if (currentLength > maxLength * 0.7) {
            charCount.style.color = '#ffc107';
        } else {
            charCount.style.color = '#6c757d';
        }
        
        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
            charCount.textContent = maxLength;
        }
    });
    
    // Auto-resize du textarea
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 200) + 'px';
    });
    
    // Animation du bouton de soumission
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.addEventListener('click', function() {
        if (textarea.value.trim()) {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Publication...';
            this.disabled = true;
        }
    });
});
</script>
@endpush
@endsection