<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['id_video', 'id_utilisateurs', 'valeur', 'commentaire'];
    
    public function video()
    {
        return $this->belongsTo(Video::class, 'id_video', 'id_video');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}