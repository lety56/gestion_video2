<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['video_id', 'auteur', 'valeur'];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id_video');
    }
}
