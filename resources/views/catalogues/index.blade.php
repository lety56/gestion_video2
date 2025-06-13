<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Vidéos Médicales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #475569;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .video-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
        
        .video-card .card-img-top {
            height: 160px;
            object-fit: cover;
        }
        
        .video-duration {
            font-size: 0.8rem;
            border-radius: 4px;
        }
        
        .recommended-badge {
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .stats-cards .card {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .stats-cards .card:hover {
            transform: translateY(-5px);
        }
        
        .pagination {
            --bs-pagination-color: var(--primary-color);
            --bs-pagination-active-bg: var(--primary-color);
            --bs-pagination-active-border-color: var(--primary-color);
        }
        
        .video-card.recommended {
            border: 2px solid #ffc107 !important;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-dropdown {
            min-width: 280px;
            padding: 10px;
        }
        
        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color);
        }
        
        /* Style de la barre de recherche */
        .search-input {
            position: relative;
            width: 100%;
        }
        .search-input input[type="text"] {
            padding-left: 2.5rem;
            border-radius: 50px !important;
            height: 45px;
            font-size: 1.1rem;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        .search-input input[type="text"]:focus {
            box-shadow: 0 0 8px rgba(13,110,253,0.7);
            border-color: #0d6efd;
        }
        .search-input .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
            font-size: 1.2rem;
        }

        /* Style des selects regroupés */
        .multi-select-group select {
            margin-bottom: 10px;
            border-radius: 8px;
            height: 40px;
            font-size: 0.95rem;
            box-shadow: 0 0 3px rgba(0,0,0,0.05);
        }

        /* Boutons */
        .btn-info {
            background: linear-gradient(90deg, #0062E6, #33AEFF);
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgb(0 98 230 / 0.3);
            transition: background 0.3s ease;
        }
        .btn-info:hover {
            background: linear-gradient(90deg, #0052c7, #1a9fff);
            box-shadow: 0 6px 20px rgb(0 82 199 / 0.6);
        }
        .btn-outline-secondary {
            border-radius: 50px;
        }

        /* Label plus lisible */
        label.form-label {
            font-weight: 600;
            font-size: 0.95rem;
            color: #444;
        }

        /* Styles pour les modales et cartes vidéo */
        .video-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .video-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }

        .star-icon {
            transition: color 0.2s ease;
        }

        .star-icon:hover,
        .star-icon.active {
            color: #ffc107 !important;
        }

        .star-label:hover ~ .star-label .star-icon {
            color: #ddd !important;
        }

        .modal-content {
            border: none;
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: 1px solid #eee;
            border-radius: 12px 12px 0 0;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        @media (max-width: 767px) {
            .video-card .card-img-top {
                height: 120px;
            }
            
            .stats-cards .card {
                margin-bottom: 15px;
            }
            
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-camera-video text-primary me-2"></i>MedVidéos
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">
                            <i class="bi bi-collection me-1"></i>Catalogue
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-star me-1"></i>Favoris
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-info-circle me-1"></i>À propos
                        </a>
                    </li>
                </ul>

                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <div class="dropdown me-3">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe me-1"></i>
                            <span class="d-none d-md-inline">{{ app()->getLocale() == 'fr' ? 'Français' : (app()->getLocale() == 'en' ? 'English' : 'العربية') }}</span>
                            <span class="d-md-none">{{ strtoupper(app()->getLocale()) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}">
                                    <i class="bi bi-check-circle-fill text-success me-2 {{ app()->getLocale() == 'fr' ? '' : 'invisible' }}"></i>
                                    🇫🇷 Français
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                                    <i class="bi bi-check-circle-fill text-success me-2 {{ app()->getLocale() == 'en' ? '' : 'invisible' }}"></i>
                                    🇺🇸 English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">
                                    <i class="bi bi-check-circle-fill text-success me-2 {{ app()->getLocale() == 'ar' ? '' : 'invisible' }}"></i>
                                    🇸🇦 العربية
                                </a>
                            </li>
                        </ul>
                    </div>

                    @auth
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar_url ?? '/default-avatar.png' }}" alt="Photo de profil" class="avatar me-2" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                <div class="d-flex flex-column align-items-start">
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    <span class="badge bg-success small">{{ __('Connecté') }}</span>
                                </div>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown" style="min-width: 280px;">
                                <li>
                                    <div class="d-flex px-3 py-2 align-items-center border-bottom mb-2">
                                        <img src="{{ Auth::user()->avatar_url ?? '/default-avatar.png' }}" alt="Photo de profil" class="avatar me-3" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                            <span class="text-muted small">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                </li>
                                
                                <li><hr class="dropdown-divider"></li>
                                
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>{{ __('Déconnexion') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Connexion') }}
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-person-plus me-1"></i>{{ __('Inscription') }}
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="main-container">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Catalogue des Vidéos Médicales</h1>
            </div>

            <!-- Statistiques en haut -->
            <div class="row stats-cards mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-camera-video-fill fs-1 mb-2"></i>
                            <h5 class="card-title">5</h5>
                            <p class="card-text">Vidéos Totales</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-folder-fill fs-1 mb-2"></i>
                            <h5 class="card-title">5</h5>
                            <p class="card-text">Catégories</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-clipboard2-pulse-fill fs-1 mb-2"></i>
                            <h5 class="card-title">4</h5>
                            <p class="card-text">Types d'Opérations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body text-center">
                            <i class="bi bi-activity fs-1 mb-2"></i>
                            <h5 class="card-title">3</h5>
                            <p class="card-text">Pathologies</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de recherche -->
            <form action="#" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="titre" class="form-label">Rechercher par titre de vidéo</label>
                    <div class="search-input">
                        <input type="text" class="form-control" id="titre" name="titre" 
                               placeholder="Ex: Chirurgie cardiaque, Arthroscopie..." 
                               aria-label="Recherche par titre" value="{{ request('titre') }}">
                        <span class="input-icon"><i class="bi bi-search"></i></span>
                    </div>
                </div>

                <div class="col-md-6 multi-select-group">
                    <label class="form-label">Filtres</label>
                    <select class="form-select mb-2" id="type_operation" name="type_operation_id">
                        <option value="">Tous les types</option>
                        @foreach($typeOperations as $type_operation)
                            <option value="{{ $type_operation->id_type_operations }}" 
                                {{ request('type_operation_id') == $type_operation->id_type_operations ? 'selected' : '' }}>
                                {{ $type_operation->nom_type_operation }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select" id="pathologie" name="pathologie_id">
                        <option value="">Toutes les pathologies</option>
                        @foreach($pathologies as $pathologie)
                           <option value="{{ $pathologie->id_pathologie }}" 
                               {{ request('pathologie_id') == $pathologie->id_pathologie ? 'selected' : '' }}>
                               {{ $pathologie->nom_pathologie ?? $pathologie->libelle }}
                           </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="docteur" class="form-label">Nom du docteur</label>
                    <input type="text" class="form-control" id="docteur" name="docteur" placeholder="Ex: Dr. Dupont" value="{{ request('docteur') }}">
                </div>

                <div class="col-md-3">
                    <label for="note_min" class="form-label">Note minimale</label>
                    <select class="form-select" id="note_min" name="note_min">
                        <option value="" {{ request('note_min') === null ? 'selected' : '' }}>Toutes les notes</option>
                        <option value="5" {{ request('note_min') == 5 ? 'selected' : '' }}>★★★★★ (5)</option>
                        <option value="4" {{ request('note_min') == 4 ? 'selected' : '' }}>★★★★☆ (4+)</option>
                        <option value="3" {{ request('note_min') == 3 ? 'selected' : '' }}>★★★☆☆ (3+)</option>
                        <option value="2" {{ request('note_min') == 2 ? 'selected' : '' }}>★★☆☆☆ (2+)</option>
                        <option value="1" {{ request('note_min') == 1 ? 'selected' : '' }}>★☆☆☆☆ (1+)</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="date_debut" class="form-label">Date début</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ request('date_debut') }}">
                </div>

                <div class="col-md-3">
                    <label for="date_fin" class="form-label">Date fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ request('date_fin') }}">
                </div>

                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-info rounded-pill px-5 me-2">
                        <i class="bi bi-funnel me-2"></i>Filtrer les résultats
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle me-2"></i>Réinitialiser
                    </a>
                </div>
            </form>

            <!-- Vue par défaut / Grid / List -->
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="view-options">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active" id="grid-view-btn">
                            <i class="bi bi-grid-3x3-gap"></i> Grille
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="list-view-btn">
                            <i class="bi bi-list-ul"></i> Liste
                        </button>
                    </div>
                </div>
                <div class="sort-options">
                    <form class="d-flex align-items-center" method="GET" action="{{ url()->current() }}">
                        <label for="sort-by" class="me-2">Trier par:</label>
                        <select class="form-select form-select-sm" id="sort-by" name="sort" onchange="this.form.submit()">
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récentes</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus anciennes</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre (A-Z)</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Meilleures notes</option>
                            <option value="comments" {{ request('sort') == 'comments' ? 'selected' : '' }}>Plus commentées</option>
                        </select>
                    </form>
                </div>
            </div>

 <div id="grid-view" class="mb-4">
    <h3 class="mb-4">
        <i class="bi bi-collection me-2 text-primary"></i>Toutes les vidéos
    </h3>
    <div class="row">
        @foreach ($videos as $video)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm video-card">
                    <!-- ... (le reste de votre card reste inchangé) ... -->
                    
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('videos.show', $video->id_video) }}" class="btn btn-sm btn-primary rounded-pill">
                                <i class="bi bi-play-circle me-1"></i>Visionner
                            </a>
                            <span class="text-muted small">
                                <i class="bi bi-chat-left-text me-1"></i>{{ $video->commentaires->count() ?? 0 }}
                            </span>
                        </div>
                        
                        <div class="d-flex gap-2">
                         <div class="d-flex gap-2">
                            <!-- Option 1: Passer directement l'objet vidéo (recommandé) -->
                            <a href="{{ route('notes.create', $video) }}"
                            class="btn btn-sm btn-outline-warning rounded-pill flex-grow-1">
                                <i class="bi bi-star me-1"></i>Noter
                            </a>
                            
                            <!-- Option 2: Passer explicitement l'ID avec le bon nom de paramètre -->
                            <!-- <a href="{{ route('notes.create', ['video' => $video->id_video]) }}"
                                class="btn btn-sm btn-outline-warning rounded-pill flex-grow-1">
                                <i class="bi bi-star me-1"></i>Noter
                            </a> -->
                        </div>
                            <div class="d-flex gap-2">
                        <!-- Solution recommandée: Passer directement l'objet vidéo -->
                        <a href="{{ route('commentaires.create', $video) }}"
                        class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1">
                            <i class="bi bi-chat-dots me-1"></i>Commenter
                        </a>
                        
                        <!-- Alternative: Passer l'ID avec le bon nom de paramètre -->
                        <!-- <a href="{{ route('commentaires.create', ['video' => $video->id_video]) }}"
                            class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1">
                            <i class="bi bi-chat-dots me-1"></i>Commenter
                        </a> -->
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Vue Liste (masquée par défaut) -->
<div id="list-view" class="mb-4" style="display: none;">
    <h3 class="mb-4">
        <i class="bi bi-list-ul me-2 text-primary"></i>Toutes les vidéos
    </h3>
    <div class="card border-0 shadow-sm mb-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="ps-4">Titre</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Docteur</th>
                        <th scope="col">Date</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Note</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <img src="{{ $video->miniature ?? '/images/default-thumbnail.jpg' }}" alt="Miniature vidéo" class="rounded" style="width: 120px; height: 68px; object-fit: cover;">
                                    <div class="position-absolute bottom-0 end-0 bg-dark text-white px-1 m-1 rounded" style="font-size: 0.7rem;">{{ $video->duree ?? '00:00' }}</div>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $video->titre }}</h6>
                                    <small class="text-muted">{{ $video->nom_docteur ?? 'Inconnu' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $video->categorie->nom ?? 'Non classé' }}</span>
                        </td>
                        <td>{{ $video->nom_docteur ?? 'Inconnu' }}</td>
                        <td>{{ \Carbon\Carbon::parse($video->date_ajout)->format('d/m/Y') }}</td>
                        <td>{{ $video->duree ?? '00:00' }}</td>
                        <td>
                            <div class="rating text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($video->note) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                                <span class="ms-1 text-muted">({{ $video->avis_count ?? 0 }})</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('videos.show', $video->id_video) }}" class="btn btn-sm btn-primary rounded-pill">
                                    <i class="bi bi-play-circle me-1"></i>Visionner
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Modals pour chaque vidéo -->
    @foreach($videos as $video)
        <!-- Modal de notation -->
        <div class="modal fade" id="ratingModal{{ $video->id_video }}" tabindex="-1" aria-labelledby="ratingModalLabel{{ $video->id_video }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ratingModalLabel{{ $video->id_video }}">
                            <i class="bi bi-star-fill text-warning me-2"></i>Noter cette vidéo
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <h6 class="fw-bold">{{ $video->titre }}</h6>
                            <p class="text-muted">Quelle note donnez-vous à cette vidéo ?</p>
                        </div>
                        
                        {{-- <form action="{{ route('notes.index', $video->id_video) }}" method="POST"> --}}
                            @csrf
                            <div class="rating-input text-center mb-4">
                                <div class="d-flex justify-content-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="star-label">
                                            <input type="radio" name="note" value="{{ $i }}" class="d-none star-input">
                                            <i class="bi bi-star star-icon" data-rating="{{ $i }}" style="font-size: 2rem; cursor: pointer; color: #ddd;"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="commentaire_note{{ $video->id_video }}" class="form-label">Commentaire (optionnel)</label>
                                <textarea name="commentaire" 
                                          id="commentaire_note{{ $video->id_video }}" 
                                          class="form-control" 
                                          rows="3" 
                                          placeholder="Ajoutez un commentaire à votre note..."></textarea>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary flex-grow-1" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-warning flex-grow-1">
                                    <i class="bi bi-star-fill me-1"></i>Noter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de commentaire -->
        <div class="modal fade" id="commentModal{{ $video->id_video }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $video->id_video }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel{{ $video->id_video }}">
                            <i class="bi bi-chat-dots-fill text-primary me-2"></i>Ajouter un commentaire
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">{{ $video->titre }}</h6>
                            <p class="text-muted small">
                                <i class="bi bi-person-circle me-1"></i>{{ $video->nom_docteur ?? 'Inconnu' }}
                            </p>
                        </div>
                       
                        {{-- <form action="{{ route('commentaires.store') }}" method="POST"> --}}
                            @csrf
                            <input type="hidden" name="id_video" value="{{ $video->id_video }}">
                            
                            <div class="mb-3">
                                <label for="commentaire{{ $video->id_video }}" class="form-label">Votre commentaire</label>
                                <textarea name="commentaire"
                                          id="commentaire{{ $video->id_video }}"
                                          class="form-control @error('commentaire') is-invalid @enderror"
                                          rows="4"
                                          placeholder="Partagez votre avis sur cette vidéo..."
                                          required>{{ old('commentaire') }}</textarea>
                                @error('commentaire')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            @guest
                            <div class="mb-3">
                                <label for="nom_utilisateur{{ $video->id_video }}" class="form-label">Votre nom</label>
                                <input type="text" 
                                       name="nom_utilisateur"
                                       id="nom_utilisateur{{ $video->id_video }}"
                                       class="form-control @error('nom_utilisateur') is-invalid @enderror"
                                       placeholder="Votre nom (optionnel)"
                                       value="{{ old('nom_utilisateur') }}">
                                @error('nom_utilisateur')
                                    <div class="invalid-feedback">
                                        {{-- {{ $message }} --}}
                                    </div>
                                @enderror
                            </div>
                            @endguest
                           
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary flex-grow-1" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i>Annuler
                                </button>
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-send me-1"></i>Publier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Footer -->
    <footer class="bg-white mt-5 py-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3 text-primary">MedVidéos</h5>
                    <p class="text-muted">Une plateforme dédiée aux professionnels de la santé pour le partage de vidéos médicales éducatives.</p>
                    <div class="social-icons">
                        <a href="#" class="me-2 text-secondary"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="me-2 text-secondary"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="me-2 text-secondary"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="#" class="text-secondary"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">   
                     <h6 class="mb-3">Navigation</h6> 
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Accueil</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Catalogue</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Favoris</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">À propos</a></li>
                    </ul>
                </div> 
                <div class="col-md-2 mb-4 mb-md-0">
                    <h6 class="mb-3">Catégories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Cardiologie</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Neurologie</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Orthopédie</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Ophtalmologie</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="mb-3">Contact</h6                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>123 Rue Médicale, 75000 Paris</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i>+33 1 23 45 67 89</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i>contact@medvideos.fr</li>
                    </ul>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal">
                            <i class="bi bi-chat-left-text me-1"></i>Formulaire de contact
                        </button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-muted mb-0">&copy; 2023 MedVidéos. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline small mb-0">
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Mentions légales</a></li>
                        <li class="list-inline-item"><span class="mx-1">·</span></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Politique de confidentialité</a></li>
                        <li class="list-inline-item"><span class="mx-1">·</span></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-muted">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal de Contact -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="contactModalLabel">
                        <i class="bi bi-envelope me-2"></i>Contactez-nous
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="contactName" class="form-label">Votre nom</label>
                            <input type="text" class="form-control" id="contactName" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactEmail" class="form-label">Votre email</label>
                            <input type="email" class="form-control" id="contactEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactSubject" class="form-label">Sujet</label>
                            <select class="form-select" id="contactSubject">
                                <option selected disabled>Choisir un sujet</option>
                                <option>Question technique</option>
                                <option>Demande de partenariat</option>
                                <option>Signalement de contenu</option>
                                <option>Autre demande</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contactMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="contactMessage" rows="4" required></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i>Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gestion des vues (grille/liste)
        document.addEventListener('DOMContentLoaded', function() {
            const gridViewBtn = document.getElementById('grid-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');

            gridViewBtn.addEventListener('click', function() {
                gridView.style.display = 'block';
                listView.style.display = 'none';
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
            });

            listViewBtn.addEventListener('click', function() {
                gridView.style.display = 'none';
                listView.style.display = 'block';
                gridViewBtn.classList.remove('active');
                listViewBtn.classList.add('active');
            });

            // Gestion des étoiles de notation
            document.querySelectorAll('.star-input').forEach(input => {
                input.addEventListener('change', function() {
                    const rating = this.value;
                    const stars = this.closest('.rating-input').querySelectorAll('.star-icon');
                    
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.classList.remove('bi-star');
                            star.classList.add('bi-star-fill');
                        } else {
                            star.classList.remove('bi-star-fill');
                            star.classList.add('bi-star');
                        }
                    });
                });
            });

            // Prévisualisation des étoiles au survol
            document.querySelectorAll('.star-label').forEach(label => {
                label.addEventListener('mouseover', function() {
                    const rating = this.querySelector('.star-input').value;
                    const starsContainer = this.closest('.rating-input');
                    const stars = starsContainer.querySelectorAll('.star-icon');
                    
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.style.color = '#ffc107';
                        }
                    });
                });

                label.addEventListener('mouseout', function() {
                    const starsContainer = this.closest('.rating-input');
                    const stars = starsContainer.querySelectorAll('.star-icon');
                    const checkedStar = starsContainer.querySelector('.star-input:checked');
                    
                    stars.forEach(star => {
                        star.style.color = '#ddd';
                    });
                    
                    if (checkedStar) {
                        const rating = checkedStar.value;
                        stars.forEach((star, index) => {
                            if (index < rating) {
                                star.style.color = '#ffc107';
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>