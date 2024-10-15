<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory;
    use HasFactory, Notifiable;

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

    public function citas()
    {
        return $this->hasMany(Cita::class, 'barbero_id'); // barbero_id en la tabla 'citas'
    }

}
