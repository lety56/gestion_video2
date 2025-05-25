@extends('layouts.app')

@section('content')
<h1>Gérer les permissions pour le rôle : {{ $role->nom_role }}</h1>

<form method="POST" action="{{ route('admin.updatePermissions', $role->id_role) }}">
    @csrf
    @method('PUT')

    @foreach ($droits as $droit)
        <div>
            <strong>{{ $droit->type_ressource }}</strong> - {{ $droit->permission }}
        </div>
    @endforeach

    <!-- Exemple pour ajouter de nouvelles permissions (à personnaliser) -->
    <div id="permissions">
        <h4>Ajouter des permissions</h4>
        <input type="hidden" name="permissions[0][id_ressource]" value="1">
        <input type="hidden" name="permissions[0][type_ressource]" value="video">
        <input type="text" name="permissions[0][permission]" placeholder="lecture / écriture / suppression">
    </div>

    <button type="submit">Mettre à jour</button>
</form>
@endsection
