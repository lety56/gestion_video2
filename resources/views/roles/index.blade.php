@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des rôles</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Créer un nouveau rôle</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom du rôle</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->nom_role }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role->id_role) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('roles.edit', $role->id_role) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('roles.destroy', $role->id_role) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
