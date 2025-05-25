<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS - Pathologies</title>
  <meta content="Gestion des pathologies pour les vidéos médicales" name="description">
  <meta content="vidéos, pathologies, médical" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #2eca6a;
      --secondary-color: #0078ff;
      --dark-color: #2d2d2d;
      --light-color: #f5f5f5;
      --border-color: #e9e9e9;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: #555555;
      background-color: #f5f7fa;
      padding-top: 100px;
    }

    /* Navbar styles */
    .navbar-default {
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
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }

    .navbar-toggler {
      border: none;
      padding: 5px;
    }

    .navbar-toggler span {
      display: block;
      width: 25px;
      height: 3px;
      background-color: var(--dark-color);
      margin: 5px 0;
      transition: all 0.3s ease;
    }

    /* Content styles */
    .content-wrapper {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
      padding: 40px;
      margin-top: 30px;
      margin-bottom: 50px;
    }

    .page-title {
      position: relative;
      color: var(--dark-color);
      font-weight: 600;
      margin-bottom: 30px;
      padding-bottom: 15px;
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
    }

    .form-group {
      margin-bottom: 25px;
    }

    /* Button styles */
    .btn-success {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 12px 30px;
      font-weight: 500;
      border-radius: 5px;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(46, 202, 106, 0.3);
    }

    .btn-success:hover {
      background-color: #25a75a;
      border-color: #25a75a;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(46, 202, 106, 0.4);
    }

    /* Floating card effect */
    .card-float {
      transition: all 0.3s ease;
    }

    .card-float:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Info box */
    .info-box {
      background-color: rgba(46, 202, 106, 0.1);
      border-left: 4px solid var(--primary-color);
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 25px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .content-wrapper {
        padding: 25px;
      }
    }
  </style>
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">GESTION<span class="color-b">VIDEOS</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('videos.create') }}">
              <i class="bi bi-camera-video me-1"></i>Videos
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.create') }}">
              <i class="bi bi-tag me-1"></i>Categories
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.create') }}">
              <i class="bi bi-gear me-1"></i>Operations
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="{{ route('pathologies.create') }}">
              <i class="bi bi-heart-pulse me-1"></i>Pathologies
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>ADMIN
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="property-single.html">
                <i class="bi bi-person-gear me-2"></i>Gérer les utilisateurs
              </a>
              <a class="dropdown-item" href="blog-single.html">
                <i class="bi bi-graph-up me-2"></i>Statistiques
              </a>
              <a class="dropdown-item" href="agents-grid.html">
                <i class="bi bi-gear me-2"></i>Paramètres
              </a>
              <a class="dropdown-item" href="agent-single.html">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
              </a>
            </div>
          </li>
        </ul>
      </div>

      <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="content-wrapper">
          <h1 class="page-title">
            <i class="bi bi-heart-pulse title-icon"></i>Ajouter une Pathologie
          </h1>

          <div class="info-box mb-4">
            <h5><i class="bi bi-info-circle me-2"></i>Information</h5>
            <p class="mb-0">Les pathologies ajoutées seront disponibles pour être associées aux vidéos médicales.</p>
          </div>

          <form action="{{ route('pathologies.store') }}" method="POST" class="card-float">
            @csrf

            <div class="form-group">
              <label for="nom_pathologie" class="form-label">Nom de la Pathologie</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-bookmark-plus"></i></span>
                <input type="text" id="nom_pathologie" name="nom_pathologie" class="form-control @error('nom_pathologie') is-invalid @enderror" value="{{ old('nom_pathologie') }}" placeholder="Ex: Arthrose du genou" required>
              </div>
              @error('nom_pathologie')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="description" class="form-label">Description</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-text-paragraph"></i></span>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Décrivez la pathologie en détail...">{{ old('description') }}</textarea>
              </div>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="#" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Retour
              </a>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Ajouter la Pathologie
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ======= Footer ======= -->
  <footer class="bg-light py-4 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0">© 2025 GESTION<span style="color: var(--primary-color)">VIDEOS</span>. Tous droits réservés.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>