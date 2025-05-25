<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GESTION DES VIDEOS</title>
  <meta content="Système de gestion de vidéos médicales" name="description">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #2eca6a;
      --secondary-color: #0078ff;
      --accent-color: #f5f5f5;
      --dark-color: #313131;
      --white-color: #ffffff;
      --gray-color: #555555;
      --light-gray: #f3f3f3;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: var(--gray-color);
      background-color: var(--accent-color);
      padding-top: 90px;
    }

    /* Navbar styling */
    .navbar {
      background-color: var(--white-color);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
      transition: all 0.3s;
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 24px;
      letter-spacing: 1px;
    }

    .navbar-brand .color-b {
      color: var(--primary-color);
    }

    .navbar-nav .nav-link {
      color: var(--dark-color);
      font-weight: 500;
      padding: 10px 20px;
      transition: all 0.3s;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: var(--primary-color);
    }

    .navbar-toggler {
      border: none;
      padding: 0;
    }

    .navbar-toggler span {
      display: block;
      width: 25px;
      height: 3px;
      background-color: var(--dark-color);
      margin: 5px 0;
      transition: all 0.3s;
    }

    /* Main content */
    .main-container {
      background-color: var(--white-color);
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 40px;
    }

    h1 {
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }

    h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 70px;
      height: 3px;
      background-color: var(--primary-color);
    }

    /* Button styling */
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.3s;
    }

    .btn-primary:hover {
      background-color: #25a555;
      border-color: #25a555;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 202, 106, 0.3);
    }

    .btn-info {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      color: var(--white-color);
    }

    .btn-info:hover {
      background-color: #0069d9;
      border-color: #0069d9;
    }

    .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    /* Table styling */
    .table {
      border-collapse: separate;
      border-spacing: 0;
      border-radius: 8px;
      overflow: hidden;
      margin-top: 30px;
    }

    .table thead {
      background-color: var(--primary-color);
      color: var(--white-color);
    }

    .table thead th {
      padding: 15px;
      font-weight: 500;
      border: none;
    }

    .table tbody tr {
      transition: all 0.3s;
    }

    .table tbody tr:hover {
      background-color: var(--light-gray);
    }

    .table tbody td {
      padding: 15px;
      vertical-align: middle;
      border-top: 1px solid #dee2e6;
    }

    /* Action buttons in table */
    .action-buttons .btn {
      margin-right: 5px;
      padding: 5px 12px;
      font-size: 14px;
    }

    /* Pagination */
    .pagination {
      justify-content: center;
      margin-top: 30px;
    }

    .pagination .page-link {
      color: var(--primary-color);
      border-radius: 5px;
      margin: 0 3px;
    }

    .pagination .page-item.active .page-link {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    /* Alert styling */
    .alert {
      border-radius: 8px;
      padding: 15px 20px;
      margin-bottom: 25px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .navbar-nav {
        padding-top: 15px;
      }

      .action-buttons {
        display: flex;
        flex-direction: column;
      }

      .action-buttons .btn {
        margin-right: 0;
        margin-bottom: 5px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">GESTION<span class="color-b">VIDEOS</span></a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarDefault">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('videos.create') }}">
              <i class="bi bi-camera-video me-1"></i>Vidéos
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.create') }}">
              <i class="bi bi-folder me-1"></i>Catégories
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.create') }}">
              <i class="bi bi-clipboard2-pulse me-1"></i>Opérations
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pathologies.create') }}">
              <i class="bi bi-activity me-1"></i>Pathologies
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-lock me-1"></i>ADMIN
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus me-2"></i>Gestion Utilisateurs</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
            </ul>
          </li>
        </ul>
        
        <button class="btn btn-primary rounded-pill">
          <i class="bi bi-search me-1"></i>Rechercher
        </button>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <div class="main-container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des Vidéos</h1>
        <a href="{{ route('videos.create') }}" class="btn btn-primary rounded-pill">
          <i class="bi bi-plus-lg me-2"></i>Ajouter une vidéo
        </a>
      </div>

      <!-- Alert Message -->
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>La vidéo a été ajoutée avec succès!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <!-- Filter Options -->
      <div class="card mb-4">
        <div class="card-body">
          <form class="row g-3">
            <div class="col-md-3">
              <label for="filterCategory" class="form-label">Catégorie</label>
              <select class="form-select" id="filterCategory">
                <option value="">Toutes les catégories</option>
                <option value="1">Chirurgie</option>
                <option value="2">Consultation</option>
                <option value="3">Rééducation</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="filterDoctor" class="form-label">Docteur</label>
              <input type="text" class="form-control" id="filterDoctor" placeholder="Nom du docteur">
            </div>
            <div class="col-md-3">
              <label for="filterPatient" class="form-label">Patient</label>
              <input type="text" class="form-control" id="filterPatient" placeholder="Nom du patient">
            </div>
            <div class="col-md-3">
              <label for="filterDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="filterDate">
            </div>
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-info rounded-pill mt-3">
                <i class="bi bi-funnel me-2"></i>Filtrer
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Video Table -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Patient</th>
            <th>Docteur</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
  @foreach($videos as $video)
    <tr>
      <td>{{ $video->titre }}</td>
      <td>
        <span class="badge bg-primary">{{ $video->categorie->nom ?? 'Non défini' }}</span>
      </td>
      <td>{{ $video->nom_patient }}</td>
      <td>{{ $video->nom_docteur }}</td>
      <td>{{ \Carbon\Carbon::parse($video->date_enregistrement)->format('d/m/Y') }}</td>
      <td class="action-buttons">
     <a href="{{ route('videos.show', ['video' => $video->id_video]) }}" class="btn btn-info btn-sm rounded-pill">
    <i class="bi bi-eye me-1"></i>Voir
</a>
<a href="{{ route('videos.edit', ['video' => $video->id_video]) }}" class="btn btn-warning btn-sm rounded-pill">
    <i class="bi bi-pencil me-1"></i>Modifier
</a>

     <form action="{{ route('videos.destroy', $video->id_video) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')">
        <i class="bi bi-trash me-1"></i>Supprimer
    </button>
</form>


      </td>
    </tr>
  @endforeach
</tbody>

        
      </table>

      <!-- Pagination -->
      <div class="pagination">
        {{ $videos->links() }}
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
