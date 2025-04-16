<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $primaryKey = 'id_publicacion';
    protected $fillable = ['id_usuario','titulo','contenido'];

    
    // Relación con el modelo User
    // En esta parte tengo que relacionar el contenido entre las tablas, para saber a quien le pertenece.
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
