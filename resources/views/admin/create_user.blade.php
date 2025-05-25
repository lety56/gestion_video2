@extends('layouts.app')

@section('content')
<h1>Créer un nouvel utilisateur</h1>

<form method="POST" action="{{ route('admin.utilisateur.store') }}">
    @csrf
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="text" name="prenom" placeholder="Prénom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>

    <select name="role" required>
        <option value="">-- Sélectionnez un rôle --</option>
        @foreach($roles as $role)
            <option value="{{ $role->nom_role }}">{{ $role->nom_role }}</option>
        @endforeach
    </select><br>

    <button type="submit">Créer l'utilisateur</button>
</form>
@endsection
