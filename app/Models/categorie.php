<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie';

    protected $fillable = [
        'nom_categorie',
        'description',
        'parent_id',
    ];

    // Relation vers le parent
    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id', 'id_categorie');
    }

    // Relation vers les enfants
    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'id_categorie');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public static function roots()
    {
        return self::whereNull('parent_id')->get();
    }

    // 🔧 Ajoute cette relation manquante !
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_categorie', 'id_categorie');
    }
}
