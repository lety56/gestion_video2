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

    .category-level-1 {
      background-color: rgba(0, 120, 255, 0.05);
    }
    
    .category-level-1 td {
      padding-left: 2.5rem;
      color: #444;
      position: relative;
    }
    
    .category-level-1 td:first-child:before {
      content: "";
      position: absolute;
      left: 1rem;
      top: 50%;
      width: 20px;
      height: 1px;
      background-color: var(--secondary-color);
    }

    .animate-slide-in {
      animation: slideIn 0.5s ease forwards;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(46, 202, 106, 0.1);
    }
    
    .badge-parent {
      background-color: var(--primary-color);
    }
    
    .badge-child {
      background-color: var(--secondary-color);
    }
    
    .search-box {
      max-width: 400px;
      margin-bottom: 2rem;
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
    
    @media (max-width: 768px) {
      .btn-group {
        flex-wrap: wrap;
        gap: 0.25rem;
      }
      
      .btn-group .btn {
        margin-right: 0;
        padding: 0.25rem 0.5rem;
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
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Catégories</li>
        </ol>
      </nav>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Liste des catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success rounded-pill d-lg-none">
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
                <input type="text" class="form-control" placeholder="Rechercher une catégorie..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">Effacer</button>
              </div>
            </div>
            <div class="col-md-6 text-md-end">
              <div class="btn-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-funnel"></i> Filtrer
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#" data-filter="all">Toutes les catégories</a></li>
                  <li><a class="dropdown-item" href="#" data-filter="parent">Catégories parentes</a></li>
                  <li><a class="dropdown-item" href="#" data-filter="child">Sous-catégories</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle" id="categoriesTable">
          <thead class="table-light">
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($categories->isEmpty())
              <tr>
                <td colspan="3">
                  <div class="empty-state">
                    <div class="empty-state-icon">
                      <i class="bi bi-folder-x"></i>
                    </div>
                    <h4>Aucune catégorie trouvée</h4>
                    <p class="text-muted">Commencez par créer une nouvelle catégorie</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                      <i class="bi bi-plus-lg me-1"></i> Créer une catégorie
                    </a>
                  </div>
                </td>
              </tr>
            @else
              @foreach ($categories as $categorie)
                <tr class="category-row" data-type="parent">
                  <td>
                    <strong>{{ $categorie->nom_categorie }}</strong>
                    <span class="badge badge-parent ms-2">Parent</span>
                  </td>
                  <td>{{ $categorie->description }}</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <div class="btn-group" role="group" aria-label="Actions">
                        <a href="{{ route('categories.show', $categorie->id_categorie) }}" class="btn btn-sm btn-outline-primary" title="Voir détails" aria-label="Voir">
                          <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('categories.edit', $categorie->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier" aria-label="Modifier">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $categorie->id_categorie) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Supprimer" aria-label="Supprimer" data-id="{{ $categorie->id_categorie }}">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>

                @foreach ($categorie->children as $child)
                  <tr class="category-level-1 category-row" data-type="child">
                    <td>{{ $child->nom_categorie }} <span class="badge badge-child ms-2">Enfant</span></td>
                    <td>{{ $child->description }}</td>
                    <td>
                      <div class="d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Actions">
                          <a href="{{ route('categories.show', $child->id_categorie) }}" class="btn btn-sm btn-outline-primary" title="Voir détails" aria-label="Voir">
                            <i class="bi bi-eye"></i>
                          </a>
                          <a href="{{ route('categories.edit', $child->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier" aria-label="Modifier">
                            <i class="bi bi-pencil"></i>
                          </a>
                          <form action="{{ route('categories.destroy', $child->id_categorie) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Supprimer" aria-label="Supprimer" data-id="{{ $child->id_categorie }}">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      
      @if($categories->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div class="text-muted">
            Affichage de <span id="visibleCount">{{ $categories->count() + $categories->sum(fn($cat) => $cat->children->count()) }}</span> catégories
          </div>
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
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
          <p>Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action est irréversible.</p>
          <p class="fw-bold">Toutes les sous-catégories associées seront également supprimées.</p>
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
      <p class="mb-0">&copy; 2025 GESTION<span class="color-b">VIDEOS</span>. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Gestion de la suppression avec confirmation modale
      document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const categoryId = this.getAttribute('data-id');
          const form = this.closest('form');
          const deleteForm = document.getElementById('deleteForm');
          
          deleteForm.action = form.action;
          const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
          modal.show();
        });
      });
      
      // Fonctionnalité de recherche
      const searchInput = document.getElementById('searchInput');
      const clearSearch = document.getElementById('clearSearch');
      const categoryRows = document.querySelectorAll('.category-row');
      
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;
        
        categoryRows.forEach(row => {
          const text = row.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            row.style.display = '';
            visibleCount++;
          } else {
            row.style.display = 'none';
          }
        });
        
        document.getElementById('visibleCount').textContent = visibleCount;
      });
      
      clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
      });
      
      // Filtrage par type de catégorie
      document.querySelectorAll('[data-filter]').forEach(filter => {
        filter.addEventListener('click', function(e) {
          e.preventDefault();
          const filterType = this.getAttribute('data-filter');
          let visibleCount = 0;
          
          categoryRows.forEach(row => {
            const rowType = row.getAttribute('data-type');
            
            if (filterType === 'all' || rowType === filterType) {
              row.style.display = '';
              visibleCount++;
            } else {
              row.style.display = 'none';
            }
          });
          
          document.getElementById('visibleCount').textContent = visibleCount;
        });
      });
    });
  </script>
</body>

</html>