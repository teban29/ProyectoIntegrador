<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'password',
        'rol_id', // Agrega este campo para que Laravel lo maneje
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
