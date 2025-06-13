<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GESTION DES VIDEOS - Pathologies</title>
  <meta content="Plateforme de gestion des pathologies médicales" name="description">
  <meta content="pathologies, médical, chirurgie, gestion" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

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
    }

    .text-brand {
      font-weight: 700;
      font-size: 1.8rem;
    }

    .color-b {
      color: var(--primary-color);
    }

    .section-title {
      font-size: 2rem;
      font-weight: 600;
      position: relative;
      margin-bottom: 2rem;
      color: var(--dark-color);
    }

    .section-title:after {
      content: '';
      position: absolute;
      height: 4px;
      width: 60px;
      background-color: var(--primary-color);
      bottom: -10px;
      left: 0;
    }

    .table-actions .btn {
      padding: 0.375rem 0.75rem;
    }

    .empty-state {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 3rem;
      text-align: center;
    }

    .empty-state-icon {
      font-size: 3rem;
      color: #adb5bd;
      margin-bottom: 1rem;
    }

    .search-box {
      max-width: 400px;
    }

    @media (max-width: 768px) {
      .table-actions .btn {
        margin-bottom: 0.25rem;
        display: block;
        width: 100%;
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
            <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('type-operations.index') }}">Opérations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('pathologies.index') }}">Pathologies</a>
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

      <a href="{{ route('pathologies.create') }}" class="btn btn-sm btn-outline-success rounded-pill d-none d-lg-block">
        <i class="bi bi-plus-lg me-1"></i> Nouvelle pathologie
      </a>
    </div>
  </nav><!-- End Header/Navbar -->

  <main>
    <div class="container animate__animated animate__fadeIn">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pathologies</li>
        </ol>
      </nav>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title">Liste des Pathologies</h1>
        <a href="{{ route('pathologies.create') }}" class="btn btn-success rounded-pill d-lg-none">
          <i class="bi bi-plus-lg me-1"></i> Nouvelle
        </a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group search-box">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Rechercher une pathologie..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">Effacer</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle" id="pathologiesTable">
          <thead class="table-light">
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($pathologies->isEmpty())
              <tr>
                <td colspan="3">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h4>Aucune pathologie enregistrée</h4>
                    <p class="text-muted">Commencez par créer une nouvelle pathologie</p>
                    <a href="{{ route('pathologies.create') }}" class="btn btn-primary">
                      <i class="bi bi-plus-lg me-1"></i> Ajouter une pathologie
                    </a>
                  </div>
                </td>
              </tr>
            @else
              @foreach ($pathologies as $pathologie)
                <tr class="pathology-row">
                  <td><strong>{{ $pathologie->nom_pathologie }}</strong></td>
                  <td>{{ Str::limit($pathologie->description, 100) }}</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <div class="btn-group table-actions" role="group" aria-label="Actions">
                        <a href="{{ route('pathologies.show', $pathologie->id_pathologie) }}" class="btn btn-sm btn-outline-primary" title="Voir détails">
                          <i class="bi bi-eye"></i> <span class="d-none d-md-inline">Détails</span>
                        </a>
                        <a href="{{ route('pathologies.edit', $pathologie->id_pathologie) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                          <i class="bi bi-pencil"></i> <span class="d-none d-md-inline">Modifier</span>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Supprimer" data-id="{{ $pathologie->id_pathologie }}">
                          <i class="bi bi-trash"></i> <span class="d-none d-md-inline">Supprimer</span>
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      
      @if($pathologies->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div class="text-muted">
            Affichage de {{ $pathologies->count() }} pathologies
          </div>
          {{-- {{ $pathologies->links() }} --}}
        </div>
      @endif
    </div>
  </main>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Êtes-vous sûr de vouloir supprimer cette pathologie ? Cette action est irréversible.</p>
          <p class="fw-bold">Toutes les données associées seront également supprimées.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-light py-4 mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; 2023 GESTION<span class="color-b">VIDEOS</span>. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Gestion de la suppression avec confirmation modale
      document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const pathologyId = this.getAttribute('data-id');
          const deleteForm = document.getElementById('deleteForm');
          
          deleteForm.action = `{{ url('pathologies') }}/${pathologyId}`;
          const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
          modal.show();
        });
      });
      
      // Fonctionnalité de recherche
      const searchInput = document.getElementById('searchInput');
      const clearSearch = document.getElementById('clearSearch');
      const pathologyRows = document.querySelectorAll('.pathology-row');
      
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        pathologyRows.forEach(row => {
          const text = row.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
      
      clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
      });
    });
  </script>
</body>

</html>