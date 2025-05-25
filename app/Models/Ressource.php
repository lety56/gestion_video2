<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ressource';
    protected $fillable = ['nom_ressource', 'type_ressource', 'description'];

    /**
     * Obtenir tous les droits d'accès liés à cette ressource
     */
    public function droitsAcces()
    {
        return $this->hasMany(DroitAcces::class, 'id_ressource', 'id_ressource');
    }
}
