@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des notes</h2>
        <div>
            <a href="{{ route('notes.create', ['video' => $videos->first()->id_video]) }}" class="btn btn-primary me-2">
    <i class="bi bi-plus-circle"></i> Ajouter une note
</a>

            <a href="{{ route('videos.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Retour aux vidéos
            </a>
        </div>
    </div>

    <!-- Ici la liste des notes -->

</div>

    
    <!-- Gestion des messages de session -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($notes->isEmpty())
        <div class="alert alert-info">
            Aucune note n'a été enregistrée pour le moment.
        </div>
    @else
        <div class="card shadow-sm">
            <!-- Options de filtrage -->
            <div class="card-header bg-white py-3">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="videoFilter">
                            <option value="">Toutes les vidéos</option>
                            @foreach($videos as $video)
                                <option value="{{ $video->id }}">{{ Str::limit($video->titre, 30) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="ratingFilter">
                            <option value="">Toutes les notes</option>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Rechercher dans les commentaires..." id="commentSearch">
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="notesTable">
                    <thead class="table-light">
                        <tr>
                            <th width="25%">Vidéo</th>
                            <th width="15%">Note</th>
                            <th width="35%">Commentaire</th>
                            <th width="15%">Utilisateur</th>
                            <th width="10%">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                        <tr data-video="{{ $note->video_id }}" data-rating="{{ $note->valeur }}" data-comment="{{ strtolower($note->commentaire) }}">
                            <td>
                                <a href="{{ route('videos.show', $note->video) }}" class="text-decoration-none">
                                    {{ Str::limit($note->video->titre, 40) }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning text-dark me-2">{{ $note->valeur }}/5</span>
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $note->valeur)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($note->commentaire)
                                    <div class="comment-container" data-bs-toggle="tooltip" title="{{ $note->commentaire }}">
                                        <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                            {{ $note->commentaire }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-muted">Aucun commentaire</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($note->user->avatar)
                                        <img src="{{ asset('storage/' . $note->user->avatar) }}" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                                    @else
                                        <div class="avatar-placeholder bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                            {{ substr($note->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span>{{ $note->user->name ?? 'Anonyme' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted">
                                    {{ $note->created_at->format('d/m/Y') }}
                                    <div class="text-nowrap">{{ $note->created_at->format('H:i') }}</div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($notes->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Affichage de {{ $notes->firstItem() }} à {{ $notes->lastItem() }} sur {{ $notes->total() }} notes
                </div>
                {{ $notes->links() }}
            </div>
            @endif
            
            <!-- Aucun résultat -->
            <div class="d-none" id="noResults">
                <div class="alert alert-warning m-4">
                    <i class="bi bi-exclamation-circle me-2"></i> Aucune note ne correspond à vos critères de recherche
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .star-rating {
        font-size: 0.9rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    .text-truncate {
        display: inline-block;
        vertical-align: middle;
    }
    
    .comment-container:hover {
        cursor: pointer;
        text-decoration: underline dotted;
    }
    
    .avatar-placeholder {
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les tooltips Bootstrap
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        // Éléments du DOM
        const videoFilter = document.getElementById('videoFilter');
        const ratingFilter = document.getElementById('ratingFilter');
        const commentSearch = document.getElementById('commentSearch');
        const clearSearch = document.getElementById('clearSearch');
        const notesTable = document.getElementById('notesTable');
        const noResults = document.getElementById('noResults');
        const rows = notesTable.querySelectorAll('tbody tr');
        
        // Fonction de filtrage
        function filterNotes() {
            const videoValue = videoFilter.value;
            const ratingValue = ratingFilter.value;
            const searchTerm = commentSearch.value.toLowerCase();
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                const videoMatch = videoValue === '' || row.dataset.video === videoValue;
                const ratingMatch = ratingValue === '' || row.dataset.rating === ratingValue;
                const commentMatch = searchTerm === '' || row.dataset.comment.includes(searchTerm);
                
                if (videoMatch && ratingMatch && commentMatch) {
                    row.classList.remove('d-none');
                    visibleCount++;
                } else {
                    row.classList.add('d-none');
                }
            });
            
            // Afficher/masquer le message "Aucun résultat"
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
                noResults.classList.add('d-block');
            } else {
                noResults.classList.remove('d-block');
                noResults.classList.add('d-none');
            }
        }
        
        // Écouteurs d'événements
        videoFilter.addEventListener('change', filterNotes);
        ratingFilter.addEventListener('change', filterNotes);
        commentSearch.addEventListener('input', filterNotes);
        
        clearSearch.addEventListener('click', function() {
            commentSearch.value = '';
            filterNotes();
        });
        
        // Initialiser le filtrage
        filterNotes();
    });
</script>
@endsection