<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Ressource;
use App\Models\DroitAcces;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Afficher la liste des rôles
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Afficher le formulaire de création de rôle
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Enregistrer un nouveau rôle
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_role' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
        ]);

        $role = Role::create($validatedData);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Afficher un rôle spécifique
     */
    public function show(Role $role)
    {
        $droitsAcces = $role->droitsAcces;
        return view('admin.roles.show', compact('role', 'droitsAcces'));
    }

    /**
     * Afficher le formulaire de modification d'un rôle
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Mettre à jour un rôle
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'nom_role' => 'required|string|max:255|unique:roles,nom_role,' . $role->id_role . ',id_role',
            'description' => 'nullable|string',
        ]);

        $role->update($validatedData);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Supprimer un rôle
     */
    public function destroy(Role $role)
    {
        // Vérifier si des utilisateurs sont associés à ce rôle
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Impossible de supprimer ce rôle car des utilisateurs y sont associés.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rôle supprimé avec succès.');
    }

    /**
     * Afficher la page de gestion des permissions
     */
    public function managePermissions(Role $role)
    {
        $ressources = Ressource::all();
        $ressourceTypes = ['video', 'categorie', 'annotation'];
        
        // Récupérer les permissions existantes pour ce rôle
        $permissions = $role->droitsAcces;
        
        return view('admin.roles.permissions', compact('role', 'ressources', 'ressourceTypes', 'permissions'));
    }

    /**
     * Enregistrer les permissions du rôle
     */
    public function savePermissions(Request $request, Role $role)
    {
        // Validation des données
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*.type_ressource' => 'required|string',
            'permissions.*.id_ressource' => 'nullable|exists:ressources,id_ressource',
            'permissions.*.permissions' => 'required|array',
        ]);

        // Supprimer les anciennes permissions
        DroitAcces::where('id_role', $role->id_role)->delete();

        // Ajouter les nouvelles permissions
        foreach ($request->permissions as $permission) {
            DroitAcces::create([
                'id_role' => $role->id_role,
                'id_ressource' => $permission['id_ressource'] ?? null,
                'ressource_specifique_id' => $permission['ressource_specifique_id'] ?? null,
                'type_ressource' => $permission['type_ressource'],
                'permission_lecture' => in_array('lecture', $permission['permissions']),
                'permission_ecriture' => in_array('ecriture', $permission['permissions']),
                'permission_modification' => in_array('modification', $permission['permissions']),
                'permission_suppression' => in_array('suppression', $permission['permissions']),
            ]);
        }

        return redirect()->route('admin.roles.show', $role)
            ->with('success', 'Permissions mises à jour avec succès.');
    }
}
