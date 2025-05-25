<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DroitAcces extends Model
{
    use HasFactory;

    protected $table = 'droits_acces';
    protected $primaryKey = 'id_droit';
    
    protected $fillable = [
        'id_role',
        'id_ressource',
        'ressource_specifique_id',
        'type_ressource',
        'permission_lecture',
        'permission_ecriture',
        'permission_modification',
        'permission_suppression'
    ];

    /**
     * Convertit les attributs booléens
     */
    protected $casts = [
        'permission_lecture' => 'boolean',
        'permission_ecriture' => 'boolean',
        'permission_modification' => 'boolean',
        'permission_suppression' => 'boolean',
    ];

    /**
     * Obtenir le rôle associé à ce droit d'accès
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    /**
     * Obtenir la ressource générique associée
     */
    public function ressource()
    {
        return $this->belongsTo(Ressource::class, 'id_ressource', 'id_ressource');
    }
}
