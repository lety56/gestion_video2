<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS - Ajouter une catégorie</title>
  <meta content="Plateforme de gestion de vidéos médicales" name="description">
  <meta content="vidéos, médical, chirurgie, catégories" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
  <style>
    :root {
      --primary-color: #2eca6a;
      --secondary-color: #0078ff;
      --dark-color: #313131;
      --light-color: #f5f5f5;
      --danger-color: #dc3545;
      --success-color: #28a745;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #555;
      padding-top: 90px;
    }
    
    .navbar {
      background-color: #fff;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      padding: 0.8rem 0;
    }
    
    .text-brand {
      font-weight: 700;
      font-size: 1.8rem;
    }
    
    .color-b {
      color: var(--primary-color);
    }
    
    .section-title {
      font-size: 2.2rem;
      font-weight: 600;
      position: relative;
      margin-bottom: 3rem;
      color: var(--dark-color);
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      height: 4px;
      width: 60px;
      background-color: var(--primary-color);
      bottom: -15px;
      left: 0;
    }
    
    .form-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
      padding: 3rem;
      margin-bottom: 3rem;
      position: relative;
      overflow: hidden;
    }
    
    .form-container:before {
      content: '';
      position: absolute;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: rgba(46, 202, 106, 0.1);
      top: -50px;
      right: -50px;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .form-label {
      font-weight: 500;
      margin-bottom: 0.5rem;
      color: #444;
    }
    
    .form-control {
      border-radius: 4px;
      padding: 0.8rem 1rem;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(46, 202, 106, 0.1);
    }
    
    .form-control.is-invalid {
      border-color: var(--danger-color);
    }
    
    textarea.form-control {
      min-height: 120px;
    }
    
    .btn-submit {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(46, 202, 106, 0.3);
    }
    
    .btn-submit:hover {
      background-color: #27ae60;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(46, 202, 106, 0.4);
    }
    
    .btn-cancel {
      background-color: #f8f9fa;
      color: #555;
      border: 1px solid #ddd;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      font-weight: 500;
      transition: all 0.3s ease;
      margin-right: 1rem;
    }
    
    .btn-cancel:hover {
      background-color: #e9ecef;
    }
    
    .form-icon {
      background-color: var(--light-color);
      border-radius: 50%;
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
    }
    
    .form-icon i {
      font-size: 2.5rem;
      color: var(--primary-color);
    }
    
    .invalid-feedback {
      color: var(--danger-color);
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }
    
    .form-actions {
      display: flex;
      justify-content: flex-end;
      margin-top: 2rem;
    }
    
    /* Custom Select Styling */
    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 12.5l-4.5-4.5h9L8 12.5z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 16px;
    }
    
    /* Form Group with Icon */
    .input-with-icon {
      position: relative;
    }
    
    .input-icon {
      position: absolute;
      top: 50%;
      left: 1rem;
      transform: translateY(-50%);
      color: #aaa;
    }
    
    .input-with-icon .form-control {
      padding-left: 3rem;
    }
    
    .category-header {
      display: flex;
      align-items: center;
      margin-bottom: 2rem;
    }
    
    .category-title {
      margin-bottom: 0;
      margin-left: 1.5rem;
    }
    
    .breadcrumb {
      background: transparent;
      padding: 0;
      margin-bottom: 2rem;
    }
    
    .breadcrumb-item a {
      color: var(--primary-color);
    }
    
    /* Animation */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-slide-in {
      animation: slideIn 0.5s ease forwards;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .form-container {
        padding: 2rem;
      }
      
      .section-title {
        font-size: 1.8rem;
      }
    }
  </style>
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-light">
    <div class="container">
      <a class="navbar-brand text-brand" href="index.html">GESTION<span class="color-b">VIDEOS</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('videos.create') }}">Videos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('categories.create') }}">Catégories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.create') }}">Opérations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pathologies.create') }}">Pathologies</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ADMIN
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="property-single.html">Gestion des utilisateurs</a></li>
              <li><a class="dropdown-item" href="blog-single.html">Statistiques</a></li>
              <li><a class="dropdown-item" href="agents-grid.html">Paramètres</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <button type="button" class="btn btn-sm btn-outline-primary rounded-pill d-none d-lg-block">
        <i class="bi bi-search me-1"></i> Rechercher
      </button>
    </div>
  </nav><!-- End Header/Navbar -->

  <main>
    <div class="container animate-slide-in">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Catégories</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
        </ol>
      </nav>

      <div class="category-header">
        <div class="form-icon">
          <i class="bi bi-folder-plus"></i>
        </div>
        <h1 class="section-title category-title">Ajouter une catégorie</h1>
      </div>

      <div class="form-container">
        <form action="{{ route('categories.store') }}" method="POST" class="row g-3">
          @csrf

          <div class="col-12 mb-4">
            <div class="alert alert-info" role="alert">
              <i class="bi bi-info-circle me-2"></i>
              Les catégories permettent d'organiser vos vidéos pour une navigation plus facile.
            </div>
          </div>

          <!-- Nom de la catégorie -->
          <div class="col-12 col-md-6 mb-4">
            <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
            <div class="input-with-icon">
              <i class="bi bi-tag input-icon"></i>
              <input 
                type="text" 
                name="nom_categorie" 
                id="nom_categorie" 
                class="form-control @error('nom_categorie') is-invalid @enderror" 
                value="{{ old('nom_categorie') }}" 
                placeholder="Ex: Chirurgie cardiaque"
                required
              >
              @error('nom_categorie')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Catégorie parente -->
          <div class="col-12 col-md-6 mb-4">
            <label for="parent_id_input" class="form-label">Catégorie parente (facultatif)</label>
            <div class="input-with-icon">
              <i class="bi bi-diagram-3 input-icon"></i>
              <input 
                type="text" 
                id="parent_id_input" 
                class="form-control @error('parent_id') is-invalid @enderror" 
                placeholder="Commencez à taper pour rechercher..." 
                list="categories_list" 
                value="{{ old('parent_text') }}"
              >
              <input type="hidden" name="parent_id" id="parent_id" value="{{ old('parent_id') }}">
              <datalist id="categories_list">
                @foreach($categories as $cat)
                  <option data-id="{{ $cat->id_categorie }}" value="{{ $cat->nom_categorie }}"></option>
                @endforeach
              </datalist>
              @error('parent_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-text">Laissez vide pour créer une catégorie de premier niveau</div>
          </div>

          <!-- Description -->
          <div class="col-12 mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea 
              name="description" 
              id="description" 
              class="form-control @error('description') is-invalid @enderror" 
              placeholder="Décrivez brièvement cette catégorie..."
              required
            >{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Vidéo associée -->
          <div class="col-12 mb-4">
            <label for="video_id" class="form-label">Vidéo associée (facultatif)</label>
            <select name="video_id" id="video_id" class="form-control">
              <option value="">-- Aucune vidéo associée --</option>
              @foreach($videos as $video)
                <option value="{{ $video->id_video }}">
                  {{ $video->titre }} — {{ $video->chemin }}
                </option>
              @endforeach
            </select>
            <div class="form-text">Vous pourrez associer d'autres vidéos ultérieurement</div>
          </div>

          <!-- Boutons d'action -->
          <div class="col-12">
            <div class="form-actions">
              <a href="{{ route('categories.index') }}" class="btn btn-cancel">
                <i class="bi bi-x-circle me-2"></i>Annuler
              </a>
              <button type="submit" class="btn btn-submit">
                <i class="bi bi-check-circle me-2"></i>Ajouter la catégorie
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="bg-light py-4 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <p class="mb-0">&copy; 2025 GESTION<span class="color-b">VIDEOS</span>. Tous droits réservés.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Remplit le champ hidden parent_id à partir du datalist sélectionné
    document.getElementById('parent_id_input').addEventListener('input', function() {
      const val = this.value;
      const opts = document.getElementById('categories_list').childNodes;
      
      let found = false;
      for (let i = 0; i < opts.length; i++) {
        if (opts[i].value === val) {
          document.getElementById('parent_id').value = opts[i].dataset.id;
          found = true;
          break;
        }
      }
      
      if (!found) {
        document.getElementById('parent_id').value = '';
      }
    });
    
    // Animation des éléments au chargement
    document.addEventListener('DOMContentLoaded', function() {
      const formGroups = document.querySelectorAll('.form-group');
      formGroups.forEach((group, index) => {
        setTimeout(() => {
          group.classList.add('animate-slide-in');
        }, index * 100);
      });
    });
  </script>
</body>
</html>