<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>GESTION DES VIDEOS - Types d'Opérations</title>
  <meta content="Gestion des types d'opérations médicales" name="description">
  <meta content="vidéos, opérations, médical" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
    }

    /* Navbar styles */
    .navbar {
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
    }

    .navbar-nav .nav-link.active {
      color: var(--primary-color) !important;
    }

    /* Main content */
    .container {
      max-width: 1200px;
      padding: 20px;
    }

    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--primary-color);
    }

    .page-title {
      color: var(--dark-color);
      font-weight: 600;
      margin: 0;
    }

    /* Table styles */
    .table-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
      padding: 25px;
      margin-bottom: 40px;
    }

    .table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    .table thead th {
      background-color: var(--secondary-color);
      color: white;
      padding: 15px;
      text-align: left;
      border: none;
      position: sticky;
      top: 0;
    }

    .table tbody tr {
      transition: all 0.2s ease;
    }

    .table tbody tr:hover {
      background-color: rgba(46, 202, 106, 0.05);
    }

    .table td {
      padding: 15px;
      border-bottom: 1px solid var(--border-color);
      vertical-align: middle;
    }

    /* Button styles */
    .btn {
      padding: 8px 15px;
      border-radius: 5px;
      font-weight: 500;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn i {
      margin-right: 8px;
    }

    .btn-add {
      background-color: var(--primary-color);
      color: white;
      padding: 10px 20px;
    }

    .btn-add:hover {
      background-color: var(--primary-hover);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 202, 106, 0.3);
    }

    .btn-edit {
      background-color: var(--warning-color);
      color: var(--dark-color);
    }

    .btn-edit:hover {
      background-color: #e0a800;
      color: var(--dark-color);
    }

    .btn-delete {
      background-color: var(--error-color);
      color: white;
    }

    .btn-delete:hover {
      background-color: #c82333;
      color: white;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
    }

    /* Alert message */
    .alert-success {
      background-color: rgba(46, 202, 106, 0.2);
      border-left: 4px solid var(--primary-color);
      color: var(--dark-color);
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      body {
        padding-top: 70px;
      }
      
      .table-container {
        padding: 15px;
        overflow-x: auto;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 5px;
      }
      
      .btn {
        width: 100%;
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
            <a class="nav-link active" href="{{ route('type-operations.create') }}">
              <i class="bi bi-gear"></i>Operations
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('pathologies.create') }}">
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
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
              </a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container">
    <div class="page-header">
      <h1 class="page-title">
        <i class="bi bi-gear-fill me-2"></i>Types d'Opérations
      </h1>
      <a href="{{ route('type-operations.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle"></i>Ajouter un Type
      </a>
    </div>

    @if(session('success'))
      <div class="alert-success">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
      </div>
    @endif

    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($types as $type)
          <tr>
            <td>{{ $type->nom_type_operation }}</td>
            <td>{{ $type->description ?? 'N/A' }}</td>
            <td>
              <div class="action-buttons">
                <a href="{{ route('type-operations.edit', $type->id_type_operations) }}" class="btn btn-edit">
                  <i class="bi bi-pencil"></i>Modifier
                </a>
                
                <form action="{{ route('type-operations.destroy', $type->id_type_operations) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'opération ?')">
                    <i class="bi bi-trash"></i>Supprimer
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>