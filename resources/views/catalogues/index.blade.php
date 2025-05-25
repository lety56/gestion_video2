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
        
        @media (max-width: 767px) {
            .video-card .card-img-top {
                height: 120px;
            }
            
            .stats-cards .card {
                margin-bottom: 15px;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
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
                
               @auth

               
<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ Auth::user()->avatar_url ?? '/default-avatar.png' }}" alt="Photo de profil" class="avatar me-2">
        <div>
            <span class="d-none d-md-inline me-1">{{ Auth::user()->name }}</span>
            <span class="badge bg-success">Connecté</span>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow user-dropdown" aria-labelledby="userDropdown">
        <li>
            <div class="d-flex px-3 py-2 align-items-center border-bottom mb-2">
                <img src="{{ Auth::user()->avatar_url ?? '/default-avatar.png' }}" alt="Photo de profil" class="avatar me-3">
                <div>
                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                    <span class="text-muted small">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </li>
        {{-- <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person me-2"></i>Mon profil</a></li>
        <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
        <li><a class="dropdown-item" href="{{ route('contributions') }}"><i class="bi bi-upload me-2"></i>Mes contributions</a></li> --}}
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </button>
            </form>
        </li>
    </ul>
</div>
@else
<a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
@endauth

                
                <!-- Non connecté (caché par défaut) -->
                <div class="d-none">
                    <a href="#" class="btn btn-outline-primary me-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                    </a>
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-person-plus me-1"></i>Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-globe me-2"></i> {{ strtoupper(app()->getLocale()) }}
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="languageDropdown">
        @if (is_array(config('app.locales')))
            @foreach (config('app.locales') as $locale => $language)
                <li>
                    <a class="dropdown-item" href="{{ route('language.switch', $locale) }}">
                        {{ $language }}
                    </a>
                </li>
            @endforeach
        @else
            <li>
                <span class="dropdown-item text-muted">Langues non disponibles</span>
            </li>
        @endif
    </ul>
</div>


    <div class="container">
        <div class="main-container">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Catalogue des Vidéos Médicales</h1>
                <div>
                   
                </div>
            </div>

            <!-- Message de succès -->
              {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>Vidéo ajoutée avec succès ! 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>    --}}

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
{{-- 
            <!-- Recherche Avancée -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-search me-2"></i>Recherche Avancée</h5>
                        <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse" id="collapseSearch">
                    <div class="card-body">
                        <form action="#" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label for="titre" class="form-label">Titre de la vidéo</label>
                                <input type="text" class="form-control" id="titre" name="titre" aria-label="Recherche par titre">
                            </div>
                            <div class="col-md-3">
                                <label for="categorie" class="form-label">Catégorie</label>
                                <select class="form-select" id="categorie" name="categorie_id">
                                    <option value="">Toutes les catégories</option>
                                    <option value="1">Chirurgie cardiaque</option>
                                    <option value="2">Neurochirurgie</option>
                                    <option value="3">Chirurgie orthopédique</option>
                                    <option value="4">Chirurgie plastique</option>
                                    <option value="5">Ophtalmologie</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="type_operation" class="form-label">Type d'opération</label>
                                <select class="form-select" id="type_operation" name="type_operation_id">
                                    <option value="">Tous les types</option>
                                    <option value="1">Endoscopie</option>
                                    <option value="2">Laparoscopie</option>
                                    <option value="3">Robotique</option>
                                    <option value="4">Conventionnelle</option>
                                    <option value="5">Microchirurgie</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="pathologie" class="form-label">Pathologie</label>
                                <select class="form-select" id="pathologie" name="pathologie_id">
                                    <option value="">Toutes les pathologies</option>
                                    <option value="1">Cancer</option>
                                    <option value="2">Maladie cardiaque</option>
                                    <option value="3">Trouble neurologique</option>
                                    <option value="4">Trauma</option>
                                    <option value="5">Malformation congénitale</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="docteur" class="form-label">Docteur</label>
                                <input type="text" class="form-control" id="docteur" name="docteur" placeholder="Nom du docteur">
                            </div>
                            <div class="col-md-3">
                                <label for="note_min" class="form-label">Note minimale</label>
                                <select class="form-select" id="note_min" name="note_min">
                                    <option value="">Toutes les notes</option>
                                    <option value="5">★★★★★ (5)</option>
                                    <option value="4">★★★★☆ (4+)</option>
                                    <option value="3">★★★☆☆ (3+)</option>
                                    <option value="2">★★☆☆☆ (2+)</option>
                                    <option value="1">★☆☆☆☆ (1+)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="date_debut" class="form-label">Date début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut">
                            </div>
                            <div class="col-md-3">
                                <label for="date_fin" class="form-label">Date fin</label>
                                <input type="date" class="form-control" id="date_fin" name="date_fin">
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-info rounded-pill px-4 text-white">
                                    <i class="bi bi-funnel me-2"></i>Filtrer les résultats
                                </button>
                                <a href="#" class="btn btn-outline-secondary rounded-pill ms-2">
                                    <i class="bi bi-x-circle me-2"></i>Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
           <!-- Barre de recherche titre avec icône -->
    <style>
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
</style>

<form action="#" method="GET" class="row g-3 align-items-end">

    <!-- Barre de recherche titre avec icône -->
    <div class="col-md-6">
        <label for="titre" class="form-label">Rechercher par titre de vidéo</label>
        <div class="search-input">
            <input type="text" class="form-control" id="titre" name="titre" 
                   placeholder="Ex: Chirurgie cardiaque, Arthroscopie..." 
                   aria-label="Recherche par titre" value="{{ request('titre') }}">
            <span class="input-icon"><i class="bi bi-search"></i></span>
        </div>
    </div>

    <!-- Regroupement des selects -->
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

    <!-- Docteur -->
    <div class="col-md-3">
        <label for="docteur" class="form-label">Nom du docteur</label>
        <input type="text" class="form-control" id="docteur" name="docteur" placeholder="Ex: Dr. Dupont" value="{{ request('docteur') }}">
    </div>

    <!-- Note minimale -->
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

    <!-- Dates -->
    <div class="col-md-3">
        <label for="date_debut" class="form-label">Date début</label>
        <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ request('date_debut') }}">
    </div>

    <div class="col-md-3">
        <label for="date_fin" class="form-label">Date fin</label>
        <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ request('date_fin') }}">
    </div>

    <!-- Boutons -->
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

           @foreach($videos as $video)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card h-100 border-0 shadow-sm video-card">
            <div class="position-relative">
                {{-- Miniature temporaire ou personnalisée --}}
                <img src="/api/placeholder/400/225" class="card-img-top" alt="{{ $video->titre }}">

                <div class="video-duration position-absolute bottom-0 end-0 bg-dark text-white px-2 py-1 m-2 rounded">
                    {{ gmdate("i:s", $video->duree) }}
                </div>

                {{-- Badge recommandé ou favori, selon ta logique --}}
                <div class="recommended-badge position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 m-2 rounded">
                    <i class="bi bi-award-fill me-1"></i>Recommandé
                </div>
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $video->titre }}</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-primary">{{ $video->categorie->libelle ?? 'Sans catégorie' }}</span>
                    <div class="rating text-warning">
                        {{-- Étoiles statiques, tu peux les rendre dynamiques plus tard --}}
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <span class="ms-1 text-muted">(0)</span>
                    </div>
                </div>

                <p class="card-text text-muted small">
                    <i class="bi bi-person-circle me-1"></i>{{ $video->nom_docteur }}
                </p>

                <p class="card-text text-muted small mb-3">
                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($video->date_ajout)->format('d/m/Y') }}
                </p>

                <div class="d-flex justify-content-between">
                    {{-- Lien vers la route vidéo.show --}}
                    <a href="{{ route('videos.show', ['video' => $video->id_video]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        <i class="bi bi-play-circle me-1"></i>Visionner
                    </a>

                    <span class="text-muted small">
                        <i class="bi bi-chat-left-text me-1"></i>0
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach

                    <!-- Vue Grille des Vidéos -->
{{-- <div id="grid-view" class="mb-4">
    <h3 class="mb-4">
        <i class="bi bi-collection me-2 text-primary"></i>Toutes les vidéos
    </h3>
    <div class="row">
        @foreach ($videos as $video)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm video-card">
                    <div class="position-relative">
                        <img src="{{ $video->miniature ?? '/images/default-thumbnail.jpg' }}" class="card-img-top" alt="{{ $video->titre }}">
                        <div class="video-duration position-absolute bottom-0 end-0 bg-dark text-white px-2 py-1 m-2 rounded">
                            {{ $video->duree ?? '00:00' }}
                        </div>
                        @if ($video->est_recommande)
                            <div class="recommended-badge position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 m-2 rounded">
                                <i class="bi bi-award-fill me-1"></i>Recommandé
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->titre }}</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-primary">{{ $video->categorie->nom ?? 'Non classé' }}</span>
                            <div class="rating text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($video->note) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                                <span class="ms-1 text-muted">({{ $video->avis_count ?? 0 }})</span>
                            </div>
                        </div>
                        <p class="card-text text-muted small">
                            <i class="bi bi-person-circle me-1"></i>{{ $video->nom_docteur ?? 'Inconnu' }}
                        </p>
                        <p class="card-text text-muted small mb-3">
                            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($video->date_ajout)->format('d/m/Y') }}
                        </p>
                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="bi bi-play-circle me-1"></i>Visionner
                            </a> 

                                        <a href="{{ route('videos.show', ['video' => $video->id_video]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-play-circle me-1"></i>Visionner
                                </a>
                
                                        <span class="text-muted small">
                                <i class="bi bi-chat-left-text me-1"></i>{{ $video->commentaires_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}



    <div id="grid-view" class="mb-4">
    <h3 class="mb-4">
        <i class="bi bi-collection me-2 text-primary"></i>Toutes les vidéos
    </h3>
    <div class="row">
        @foreach ($videos as $video)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm video-card">
                    <div class="position-relative">
                        <img src="{{ $video->miniature ?? '/images/default-thumbnail.jpg' }}" class="card-img-top" alt="{{ $video->titre }}">
                        <div class="video-duration position-absolute bottom-0 end-0 bg-dark text-white px-2 py-1 m-2 rounded">
                            {{ $video->duree ?? '00:00' }}
                        </div>
                        @if ($video->est_recommande)
                            <div class="recommended-badge position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 m-2 rounded">
                                <i class="bi bi-award-fill me-1"></i>Recommandé
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->titre }}</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-primary">{{ $video->categorie->nom ?? 'Non classé' }}</span>
                            <div class="rating text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($video->note) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                                <span class="ms-1 text-muted">({{ $video->avis_count ?? 0 }})</span>
                            </div>
                        </div>
                        <p class="card-text text-muted small">
                            <i class="bi bi-person-circle me-1"></i>{{ $video->nom_docteur ?? 'Inconnu' }}
                        </p>
                        <p class="card-text text-muted small mb-3">
                            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($video->date_ajout)->format('d/m/Y') }}
                        </p>
                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="bi bi-play-circle me-1"></i>Visionner
                            </a> --}}

                                        <a href="{{ route('videos.show', ['video' => $video->id_video]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-play-circle me-1"></i>Visionner
                                </a>
                
                                        <span class="text-muted small">
                                <i class="bi bi-chat-left-text me-1"></i>{{ $video->commentaires_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $videos->links() }}
    </div>
</div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $videos->links() }}
    </div>
</div>


            <!-- List View (hidden by default) -->
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
                                <!-- Vidéo 1 -->
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3">
                                                <img src="/api/placeholder/120/68" alt="Miniature vidéo" class="rounded" style="width: 120px; height: 68px; object-fit: cover;">
                                                <div class="position-absolute bottom-0 end-0 bg-dark text-white px-1 m-1 rounded" style="font-size: 0.7rem;">16:20</div>
                                            </div>
                                          
                                        
                                    
                                </tr>
                                
                                <!-- Répéter pour d'autres vidéos -->
                                <!-- Vidéo 2 -->
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3">
                                                <img src="/api/placeholder/120/68" alt="Miniature vidéo" class="rounded" style="width: 120px; height: 68px; object-fit: cover;">
                                                <div class="position-absolute bottom-0 end-0 bg-dark text-white px-1 m-1 rounded" style="font-size: 0.7rem;">21:35</div>
                                            </div>
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

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
                    <h6 class="mb-3">Contact</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>contact@medvideos.fr</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+33 (0)1 23 45 67 89</li>
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>123 Avenue de la Médecine, 75000 Paris</li>
                    </ul>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary rounded-pill">Nous contacter</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted">© 2025 MedVidéos. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul


                    ///////////////////////////////////////////////////
                                        <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-secondary">Mentions légales</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-secondary">Politique de confidentialité</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-secondary">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optionally include Bootstrap JS if not already included -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
