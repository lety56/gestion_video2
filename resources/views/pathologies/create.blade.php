<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>GESTION DES VIDEOS - Ajouter une Pathologie</title>
  <meta content="Gestion des pathologies pour les vidéos médicales" name="description">
  <meta content="vidéos, pathologies, médical" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #2eca6a;
      --primary-hover: #25a75a;
      --secondary-color: #0078ff;
      --dark-color: #2d2d2d;
      --light-color: #f5f5f5;
      --border-color: #e9e9e9;
      --error-color: #dc3545;
      --warning-color: #ffc107;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: #555555;
      background-color: #f5f7fa;
      padding-top: 80px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar styles */
    .navbar {
      transition: all 0.5s ease;
      background-color: white;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
    }

    .text-brand .color-b {
      color: var(--primary-color);
    }

    .navbar-nav .nav-link {
      color: var(--dark-color) !important;
      font-weight: 500;
      padding: 0.7rem 1rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }

    .navbar-nav .nav-link i {
      margin-right: 5px;
      font-size: 1.1rem;
    }

    /* Content styles */
    .content-wrapper {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
      padding: 40px;
      margin: 30px 0;
      flex: 1;
    }

    .page-title {
      position: relative;
      color: var(--dark-color);
      font-weight: 600;
      margin-bottom: 30px;
      padding-bottom: 15px;
      display: flex;
      align-items: center;
    }

    .page-title::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 3px;
      background-color: var(--primary-color);
    }

    .title-icon {
      margin-right: 15px;
      color: var(--primary-color);
      font-size: 1.8rem;
    }

    /* Form styles */
    .form-control {
      padding: 12px 15px;
      border: 1px solid var(--border-color);
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 5px rgba(46, 202, 106, 0.3);
    }

    .form-label {
      font-weight: 500;
      color: var(--dark-color);
      margin-bottom: 8px;
      display: block;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .input-group-text {
      background-color: rgba(46, 202, 106, 0.1);
      border-color: var(--border-color);
      color: var(--primary-color);
    }

    /* Validation styles */
    .is-invalid {
      border-color: var(--error-color) !important;
    }

    .is-invalid:focus {
      box-shadow: 0 0 5px rgba(220, 53, 69, 0.3) !important;
    }

    .invalid-feedback {
      color: var(--error-color);
      font-size: 0.875rem;
      margin-top: 5px;
    }

    /* Button styles */
    .btn {
      padding: 12px 25px;
      font-weight: 500;
      border-radius: 5px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-success {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      box-shadow: 0 5px 15px rgba(46, 202, 106, 0.3);
    }

    .btn-success:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(46, 202, 106, 0.4);
    }

    .btn-outline-secondary {
      border-color: var(--border-color);
    }

    .btn-outline-secondary:hover {
      background-color: var(--light-color);
    }

    .btn i {
      margin-right: 8px;
    }

    /* Info box */
    .info-box {
      background-color: rgba(46, 202, 106, 0.1);
      border-left: 4px solid var(--primary-color);
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 25px;
    }

    .info-box h5 {
      display: flex;
      align-items: center;
      color: var(--dark-color);
      margin-bottom: 10px;
    }

    .info-box i {
      margin-right: 10px;
      color: var(--primary-color);
    }

    /* Footer */
    footer {
      background-color: white;
      box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.05);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      body {
        padding-top: 70px;
      }
      
      .content-wrapper {
        padding: 25px 20px;
      }
      
      .btn {
        width: 100%;
        margin-bottom: 10px;
      }
      
      .d-flex.justify-content-between {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand text-brand" href="{{ route('home') }}">GESTION<span class="color-b">VIDEOS</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('videos.create') }}">
              <i class="bi bi-camera-video"></i>Videos
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.create') }}">
              <i class="bi bi-tag"></i>Categories
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.create') }}">
              <i class="bi bi-gear"></i>Operations
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('pathologies.create') }}">
              <i class="bi bi-heart-pulse"></i>Pathologies
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>ADMIN
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">
                <i class="bi bi-person-gear me-2"></i>Gérer les utilisateurs
              </a></li>
              <li><a class="dropdown-item" href="#">
                <i class="bi bi-graph-up me-2"></i>Statistiques
              </a></li>
              <li><a class="dropdown-item" href="#">
                <i class="bi bi-gear me-2"></i>Paramètres
              </a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
              </a></li>
            </ul>
          </li>
        </ul>
      </div>

      <button type="button" class="btn btn-outline-secondary d-lg-none" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="content-wrapper">
          <h1 class="page-title">
            <i class="bi bi-heart-pulse title-icon"></i>Ajouter une Pathologie
          </h1>

          <div class="info-box">
            <h5><i class="bi bi-info-circle"></i>Information</h5>
            <p class="mb-0">Les pathologies ajoutées seront disponibles pour être associées aux vidéos médicales. Veuillez fournir des informations claires et précises.</p>
          </div>

          <form action="{{ route('pathologies.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="form-group">
              <label for="nom_pathologie" class="form-label">Nom de la Pathologie *</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-bookmark-plus"></i></span>
                <input type="text" id="nom_pathologie" name="nom_pathologie" class="form-control @error('nom_pathologie') is-invalid @enderror" value="{{ old('nom_pathologie') }}" placeholder="Ex: Arthrose du genou" required>
                @error('nom_pathologie')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <small class="text-muted">Maximum 255 caractères</small>
            </div>

            <div class="form-group">
              <label for="description" class="form-label">Description</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-text-paragraph"></i></span>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Décrivez la pathologie en détail...">{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <small class="text-muted">Optionnel mais recommandé</small>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>Retour
              </a>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>Ajouter la Pathologie
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- ======= Footer ======= -->
  <footer class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0">© 2025 GESTION<span style="color: var(--primary-color)">VIDEOS</span>. Tous droits réservés.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Form Validation -->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'
      
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')
      
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            
            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>
</html>