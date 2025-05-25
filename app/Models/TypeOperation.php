<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOperation extends Model
{
    use HasFactory;

    protected $table = 'type_operations';

    protected $primaryKey = 'id_type_operation';  // Singulier et conforme à la DB

    protected $fillable = ['nom_type_operation', 'description'];

    public function videos()
    {
        return $this->hasMany(Video::class, 'id_type_operation', 'id_type_operation');
    }
}
