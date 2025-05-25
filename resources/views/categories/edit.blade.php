@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier la catégorie</h1>

    <form action="{{ route('categories.update', $categorie->id_categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_categorie">Nom de la catégorie</label>
            <input 
                type="text" 
                name="nom_categorie" 
                id="nom_categorie" 
                class="form-control" 
                value="{{ old('nom_categorie', $categorie->nom_categorie) }}" 
                required 
            />
        </div>

        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control" 
                rows="4" 
                required
            >{{ old('description', $categorie->description) }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="parent_id">Catégorie parente</label>
               <select name="parent_id" id="parent_id" class="form-control">
    <option value="">Aucune catégorie parente</option>
    @foreach($categories as $parent)
        <option value="{{ $parent->id_categorie }}" 
            {{ $categorie->parent_id == $parent->id_categorie ? 'selected' : '' }}>
            {{ $parent->nom_categorie }}
        </option>
    @endforeach
</select>


        </div>

        <div class="form-group mt-3">
            <label for="video_id">Vidéo associée</label>
            <select name="video_id" id="video_id" class="form-control">
                <option value="">Aucune vidéo</option>
                @foreach($videos as $video)
                    <option value="{{ $video->id_video }}" 
                        {{ $categorie->video_id == $video->id_video ? 'selected' : '' }}>
                        {{ $video->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

    <h2 class="mt-5">Sous-catégories</h2>
    @if($categorie->children->isEmpty())
        <p>Aucune sous-catégorie associée à cette catégorie.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorie->children as $child)
                    <tr>
                        <td>{{ $child->nom_categorie }}</td>
                        <td>{{ Str::limit($child->description, 50) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('categories.edit', $child->id_categorie) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $child->id_categorie) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
