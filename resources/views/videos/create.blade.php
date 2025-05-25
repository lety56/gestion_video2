<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS</title>
  <meta content="Système de gestion de vidéos médicales" name="description">
  <meta content="vidéos, médical, gestion" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #3f51b5;
      --primary-light: #757de8;
      --primary-dark: #002984;
      --accent-color: #ff4081;
      --text-color: #333;
      --light-bg: #f8f9fa;
      --border-radius: 8px;
      --box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      background-color: #f4f7fa;
      padding-top: 80px;
    }
    
    /* Navbar styling */
    .navbar {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 22px;
    }
    
    .color-b {
      color: var(--primary-color);
    }
    
    .navbar-nav .nav-link {
      font-weight: 500;
      color: #444 !important;
      margin: 0 10px;
      position: relative;
      transition: var(--transition);
    }
    
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }
    
    .navbar-nav .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: var(--transition);
    }
    
    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
      width: 100%;
    }
    
    .dropdown-menu {
      border: none;
      box-shadow: var(--box-shadow);
      border-radius: var(--border-radius);
    }
    
    .dropdown-item {
      padding: 10px 20px;
      transition: var(--transition);
    }
    
    .dropdown-item:hover {
      background-color: var(--primary-light);
      color: white;
    }
    
    /* Form styling */
    .form-wrapper {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: var(--border-radius);
      padding: 32px;
      box-shadow: var(--box-shadow);
    }
    
    .form-header {
      text-align: center;
      margin-bottom: 30px;
      position: relative;
    }
    
    .form-title {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--primary-dark);
    }
    
    .form-subtitle {
      font-size: 16px;
      color: #666;
    }
    
    .form-divider {
      height: 4px;
      width: 60px;
      background: var(--primary-color);
      margin: 15px auto;
      border-radius: 2px;
    }
    
    .form-section {
      margin-bottom: 25px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }
    
    .form-section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 20px;
      color: var(--primary-color);
    }
    
    .form-label {
      font-weight: 500;
      margin-bottom: 8px;
      display: block;
      color: #555;
    }
    
    .form-control {
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      transition: var(--transition);
    }
    
    .form-control:focus {
      border-color: var(--primary-light);
      box-shadow: 0 0 0 0.2rem rgba(63, 81, 181, 0.25);
    }
    
    .form-select {
      height: 45px;
    }
    
    .input-group-text {
      background-color: var(--primary-light);
      color: white;
      border: none;
    }
    
    .form-text {
      color: #6c757d;
      font-size: 13px;
      margin-top: 5px;
    }
    
    .form-floating > .form-control {
      height: calc(3.5rem + 2px);
      padding: 1rem 0.75rem;
    }
    
    .form-floating > label {
      padding: 1rem 0.75rem;
    }
    
    .invalid-feedback {
      color: #dc3545;
      font-size: 13px;
      margin-top: 5px;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      padding: 12px 30px;
      font-weight: 500;
      letter-spacing: 0.5px;
      box-shadow: 0 3px 5px rgba(63, 81, 181, 0.3);
      transition: var(--transition);
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 5px 10px rgba(63, 81, 181, 0.4);
    }
    
    .btn-lg {
      padding: 13px 28px;
      font-size: 16px;
    }
    
    .add-new-field {
      background-color: #f8f9fa;
      border-radius: var(--border-radius);
      padding: 15px;
      margin-top: 10px;
      border: 1px dashed #ddd;
    }
    
    .add-new-field-label {
      color: #6c757d;
      font-size: 14px;
      margin-bottom: 8px;
      display: block;
    }
    
    .file-upload {
      position: relative;
      display: inline-block;
      width: 100%;
    }
    
    .file-upload .file-upload-input {
      position: relative;
      z-index: 2;
      width: 100%;
      height: 45px;
      margin: 0;
      opacity: 0;
      cursor: pointer;
    }
    
    .file-upload .file-upload-btn {
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      z-index: 1;
      height: 45px;
      padding: 10px 15px;
      background-color: #f8f9fa;
      border: 1px dashed #ddd;
      border-radius: var(--border-radius);
      text-align: left;
      color: #6c757d;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }
    
    .file-upload .file-upload-btn i {
      margin-right: 10px;
    }
    
    .file-upload .file-upload-btn:hover {
      background-color: #f1f3f5;
    }
    
    .file-upload-text {
      margin-left: 10px;
    }
    
    .form-footer {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .form-footnote {
      color: #999;
      font-size: 13px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .form-wrapper {
        padding: 20px;
        margin: 20px;
      }
      
      .form-title {
        font-size: 22px;
      }
      
      .form-footer {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">GESTION<span class="color-b">VIDEOS</span></a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('videos.create') }}">
              <i class="bi bi-film me-1"></i>Vidéos
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.create') }}">
              <i class="bi bi-grid me-1"></i>Catégories
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.create') }}">
              <i class="bi bi-clipboard2-pulse me-1"></i>Opérations
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pathologies.create') }}">
              <i class="bi bi-heart-pulse me-1"></i>Pathologies
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-gear me-1"></i>Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">
                <i class="bi bi-people me-2"></i>Gestion des utilisateurs
              </a>
              <a class="dropdown-item" href="#">
                <i class="bi bi-gear me-2"></i>Paramètres
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
              </a>
            </div>
          </li>
        </ul>
      </div>
      
      <div class="d-flex">
        <button type="button" class="btn btn-outline-primary rounded-circle">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </nav>

  <main id="main">
    <div class="container">
      <div class="form-wrapper">
        <div class="form-header">
          <h1 class="form-title">Ajouter une nouvelle vidéo</h1>
          <div class="form-divider"></div>
          <p class="form-subtitle">Remplissez le formulaire ci-dessous pour ajouter une vidéo à la médiathèque</p>
        </div>
        
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <!-- Informations de base -->
          <div class="form-section">
            <h3 class="form-section-title">
              <i class="bi bi-info-circle me-2"></i>Informations de base
            </h3>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="titre" class="form-label">Titre de la vidéo<span class="text-danger">*</span></label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" class="form-control @error('titre') is-invalid @enderror" required>
                @error('titre')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Décrivez brièvement le contenu de la vidéo</div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="duree" class="form-label">Durée (minutes)<span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="number" id="duree" name="duree" value="{{ old('duree') }}" min="0" step="1" class="form-control @error('duree') is-invalid @enderror" required>
                  <span class="input-group-text"><i class="bi bi-clock"></i></span>
                </div>
                @error('duree')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="date_ajout" class="form-label">Date d'ajout<span class="text-danger">*</span></label>
              <input type="date" id="date_ajout" name="date_ajout" value="{{ old('date_ajout') }}" class="form-control @error('date_ajout') is-invalid @enderror" required>
              @error('date_ajout')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-6">
              <label for="date_enregistrement" class="form-label">Date d’enregistrement<span class="text-danger">*</span></label>
              <input type="date" id="date_enregistrement" name="date_enregistrement" value="{{ old('date_enregistrement') }}" class="form-control @error('date_enregistrement') is-invalid @enderror" required>
              @error('date_enregistrement')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <!-- Classification -->
          <div class="form-section">
            <h3 class="form-section-title">
              <i class="bi bi-tag me-2"></i>Classification
            </h3>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="id_categorie" class="form-label">Catégorie<span class="text-danger">*</span></label>
                <select id="id_categorie" name="id_categorie" class="form-select @error('id_categorie') is-invalid @enderror">
                  <option value="">-- Sélectionner une catégorie --</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id_categorie }}" @selected(old('id_categorie') == $cat->id_categorie)>
                      {{ $cat->nom_categorie }}
                    </option>
                  @endforeach
                </select>
                @error('id_categorie')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="add-new-field mt-2">
                  <label for="new_categorie" class="add-new-field-label">
                    <i class="bi bi-plus-circle me-1"></i>Ou ajouter une nouvelle catégorie
                  </label>
                  <input type="text" id="new_categorie" name="new_categorie" value="{{ old('new_categorie') }}" class="form-control @error('new_categorie') is-invalid @enderror">
                  @error('new_categorie')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="id_type_operation" class="form-label">Type d'opération<span class="text-danger">*</span></label>
                <select id="id_type_operation" name="id_type_operation" class="form-select @error('id_type_operation') is-invalid @enderror">
                  <option value="">-- Sélectionner un type d'opération --</option>
                  @foreach($type_operations as $type)
                    <option value="{{ $type->id_type_operation }}" @selected(old('id_type_operation') == $type->id_type_operation)>
                      {{ $type->nom_type_operation }}
                    </option>
                  @endforeach
                </select>
                @error('id_type_operation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="add-new-field mt-2">
                  <label for="new_type_operation" class="add-new-field-label">
                    <i class="bi bi-plus-circle me-1"></i>Ou ajouter un nouveau type d'opération
                  </label>
                  <input type="text" id="new_type_operation" name="new_type_operation" value="{{ old('new_type_operation') }}" class="form-control @error('new_type_operation') is-invalid @enderror">
                  @error('new_type_operation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="id_pathologie" class="form-label">Pathologie<span class="text-danger">*</span></label>
                <select id="id_pathologie" name="id_pathologie" class="form-select @error('id_pathologie') is-invalid @enderror">
                  <option value="">-- Sélectionner une pathologie --</option>
                  @foreach($pathologies as $patho)
                    <option value="{{ $patho->id_pathologie }}" @selected(old('id_pathologie') == $patho->id_pathologie)>
                      {{ $patho->nom_pathologie }}
                    </option>
                  @endforeach
                </select>
                @error('id_pathologie')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="add-new-field mt-2">
                  <label for="new_pathologie" class="add-new-field-label">
                    <i class="bi bi-plus-circle me-1"></i>Ou ajouter une nouvelle pathologie
                  </label>
                  <input type="text" id="new_pathologie" name="new_pathologie" value="{{ old('new_pathologie') }}" class="form-control @error('new_pathologie') is-invalid @enderror">
                  @error('new_pathologie')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          
          <!-- Information médicale -->
          <div class="form-section">
            <h3 class="form-section-title">
              <i class="bi bi-person-vcard me-2"></i>Information médicale
            </h3>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nom_patient" class="form-label">Nom du patient</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <input type="text" id="nom_patient" name="nom_patient" value="{{ old('nom_patient') }}" class="form-control @error('nom_patient') is-invalid @enderror">
                </div>
                @error('nom_patient')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-md-6">
                <label for="nom_docteur" class="form-label">Nom du docteur</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                  <input type="text" id="nom_docteur" name="nom_docteur" value="{{ old('nom_docteur') }}" class="form-control @error('nom_docteur') is-invalid @enderror">
                </div>
                @error('nom_docteur')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          
          <!-- Fichier et Options -->
          <div class="form-section">
            <h3 class="form-section-title">
              <i class="bi bi-file-earmark-play me-2"></i>Fichier et Options
            </h3>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="chemin_fichier" class="form-label">Fichier vidéo<span class="text-danger">*</span></label>
                <div class="file-upload">
                  <input type="file" id="chemin_fichier" name="chemin_fichier" class="file-upload-input @error('chemin_fichier') is-invalid @enderror" accept="video/*">
                  <div class="file-upload-btn">
                    <i class="bi bi-upload"></i>
                    <span class="file-upload-text">Choisir un fichier vidéo</span>
                  </div>
                </div>
                @error('chemin_fichier')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Formats acceptés: MP4, MOV, AVI, etc.</div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="est_telechargeable" class="form-label">Est téléchargeable ?</label>
                <select id="est_telechargeable" name="est_telechargeable" class="form-select @error('est_telechargeable') is-invalid @enderror">
                  <option value="">-- Choisir --</option>
                  <option value="1" @selected(old('est_telechargeable') == 1)>Oui</option>
                  <option value="0" @selected(old('est_telechargeable') == 0)>Non</option>
                </select>
                @error('est_telechargeable')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          
          <div class="form-footer">
            <div class="form-footnote">
              <span class="text-danger">*</span> Champs obligatoires
            </div>
            <div class="d-flex gap-2">
              <button type="reset" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Annuler
              </button>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-1"></i>Ajouter la vidéo
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
  
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom Script -->
  <script>
    // Update file input text when file is selected
    document.getElementById('chemin_fichier').addEventListener('change', function(e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'Choisir un fichier vidéo';
      document.querySelector('.file-upload-text').textContent = fileName;
    });
  </script>
</body>
</html>