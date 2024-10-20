<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; // Especificar la tabla si el nombre no sigue la convención

    protected $fillable = ['nombre']; // Los campos que se pueden llenar masivamente
}
