<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    // Définir la clé primaire
    protected $primaryKey = 'id_video';  // Assure-toi que la colonne primaire porte ce nom

    protected $fillable = [
        'titre',
        'description',
        'id_categorie',
        'chemin_fichier',
        'nom_patient',
        'nom_docteur',
        'nom_intervenant',
        'est_telechargeable',
        'id_type_operations',
        'id_pathologie',
        'date_enregistrement',
        'date_ajout',
           'date_intervenant',
        'duree',
    ];

    // Relation vers la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }

    // Relation vers le type d'opération
    public function typeOperation()
    {
        return $this->belongsTo(TypeOperation::class, 'id_type_operations', 'id_type_operations');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'video_id', 'id_video');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'video_id', 'id_video');
    }

    // Relation vers la pathologie
    public function pathologie()
    {
        return $this->belongsTo(Pathologie::class, 'id_pathologie', 'id_pathologie');
    }
}
