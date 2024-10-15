<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios'; // Asegúrate de que el nombre de la tabla coincida con tu base de datos

    protected $fillable = [
        'nombre', 'precio', 'duracion',
    ];
}
