<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathologie extends Model
{
    use HasFactory;
    
    protected $table = 'pathologies';

    // Indiquer la bonne clé primaire :
    protected $primaryKey = 'id_pathologie';

    protected $fillable = ['nom_pathologie', 'description'];
    
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_pathologie');
    }
}
