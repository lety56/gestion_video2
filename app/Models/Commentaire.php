<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_commentaire';
    
    protected $fillable = [
        'contenu',
        'id_video',
        'id_utilisateur'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'id_video');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
}