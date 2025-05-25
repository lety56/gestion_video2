<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_role';
    protected $fillable = ['nom_role', 'description'];

    /**
     * Récupérer tous les utilisateurs qui ont ce rôle
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id_role');
    }

    /**
     * Récupérer tous les droits d'accès associés à ce rôle
     */
    public function droitsAcces()
    {
        return $this->hasMany(DroitAcces::class, 'id_role', 'id_role');
    }

    /**
     * Vérifier si le rôle a une permission spécifique sur une ressource
     */
    public function hasPermission($typeRessource, $permissionName, $resourceId = null)
    {
        $query = $this->droitsAcces()
            ->where('type_ressource', $typeRessource);
        
        if ($resourceId) {
            $query->where(function ($q) use ($resourceId) {
                $q->where('ressource_specifique_id', $resourceId)
                  ->orWhereNull('ressource_specifique_id');
            });
        } else {
            $query->whereNull('ressource_specifique_id');
        }
        
        $permissionColumn = 'permission_' . $permissionName;
        return $query->where($permissionColumn, true)->exists();
    }
}
