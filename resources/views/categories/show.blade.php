@extends('layouts.app') {{-- Assurez-vous que vous avez un layout principal --}}
@section('title', 'Détail de la catégorie')

@section('content')
<main>
  <div class="container animate-slide-in">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Catégories</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $categorie->nom_categorie }}</li>
      </ol>
    </nav>

    <div class="category-header mb-4">
      <div class="form-icon">
        <i class="bi bi-folder"></i>
      </div>
      <h1 class="section-title category-title">Détail de la catégorie</h1>
    </div>

    <div class="form-container">
      <div class="row">
        <div class="col-md-6 mb-4">
          <h5>Nom de la catégorie</h5>
          <p><strong>{{ $categorie->nom_categorie }}</strong></p>
        </div>

        <div class="col-md-6 mb-4">
          <h5>Catégorie parente</h5>
          <p>
            @if ($categorie->parent)
              {{ $categorie->parent->nom_categorie }}
            @else
              <em>Aucune (catégorie racine)</em>
            @endif
          </p>
        </div>

        <div class="col-12 mb-4">
          <h5>Description</h5>
          <p>{{ $categorie->description }}</p>
        </div>

        <div class="col-12 mb-4">
          <h5>Vidéo associée</h5>
          <p>
            @if ($categorie->video)
              {{ $categorie->video->titre }} <br>
              <small class="text-muted">{{ $categorie->video->chemin }}</small>
            @else
              <em>Aucune vidéo associée</em>
            @endif
          </p>
        </div>

        <!-- Actions -->
        <div class="col-12">
          <div class="form-actions">
            <a href="{{ route('categories.edit', $categorie->id_categorie) }}" class="btn btn-outline-success me-2">
              <i class="bi bi-pencil me-1"></i> Modifier
            </a>

            <form action="{{ route('categories.destroy', $categorie->id_categorie) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash me-1"></i> Supprimer
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Sous-catégories --}}
    @if ($categorie->children->count())
    <div class="form-container mt-5">
      <h4 class="mb-4">Sous-catégories</h4>
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categorie->children as $child)
            <tr>
              <td><i class="bi bi-arrow-return-right me-2"></i>{{ $child->nom_categorie }}</td>
              <td>{{ $child->description }}</td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ route('categories.show', $child->id_categorie) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ route('categories.edit', $child->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('categories.destroy', $child->id_categorie) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cette sous-catégorie ?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</main>
@endsection
