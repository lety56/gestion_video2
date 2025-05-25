<form action="{{ route('admin.utilisateurs.store') }}" method="POST">
    @csrf
    <input name="nom" placeholder="Nom">
    <input name="prenom" placeholder="Prénom">
    <input name="email" type="email" placeholder="Email">
    <input name="mot_de_passe" type="password" placeholder="Mot de passe">

    <select name="role">
        @foreach($roles as $role)
            <option value="{{ $role->nom_role }}">{{ $role->nom_role }}</option>
        @endforeach
    </select>

    <button type="submit">Créer</button>
</form>
