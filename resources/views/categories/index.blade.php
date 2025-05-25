<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS - Liste des catégories</title>
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
    /* Ton CSS personnalisé (copié du style que tu as fourni) */
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

    .btn-group .btn {
      margin-right: 0.25rem;
    }

    .category-level-1 td {
      padding-left: 2rem;
      font-style: italic;
      color: #444;
    }

    .animate-slide-in {
      animation: slideIn 0.5s ease forwards;
    }

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
  </style>
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-light">
    <div class="container">
      <a class="navbar-brand text-brand" href="{{ url('/') }}">GESTION<span class="color-b">VIDEOS</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('videos.index') }}">Videos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('categories.index') }}">Catégories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.index') }}">Opérations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pathologies.index') }}">Pathologies</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ADMIN
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Gestion des utilisateurs</a></li>
              <li><a class="dropdown-item" href="#">Statistiques</a></li>
              <li><a class="dropdown-item" href="#">Paramètres</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-success rounded-pill d-none d-lg-block">
        <i class="bi bi-plus-lg me-1"></i> Nouvelle catégorie
      </a>
    </div>
  </nav><!-- End Header/Navbar -->

  <main>
    <div class="container animate-slide-in">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Catégories</li>
        </ol>
      </nav>

      <h1 class="section-title">Liste des catégories</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $categorie)
              <tr>
                <td><strong>{{ $categorie->nom_categorie }}</strong></td>
                <td>{{ $categorie->description }}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Actions">
                    <a href="{{ route('categories.show', $categorie->id_categorie) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('categories.edit', $categorie->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('categories.destroy', $categorie->id_categorie) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              @foreach ($categorie->children as $child)
                <tr class="category-level-1">
                  <td><i class="bi bi-arrow-return-right me-2"></i>{{ $child->nom_categorie }}</td>
                  <td>{{ $child->description }}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Actions">
                      <a href="{{ route('categories.show', $child->id_categorie) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="{{ route('categories.edit', $child->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <form action="{{ route('categories.destroy', $child->id_categorie) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <footer class="bg-light py-4 mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 GESTION<span class="color-b">VIDEOS</span>. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
