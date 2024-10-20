<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla

    // Definir los campos que se pueden llenar de manera masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'marca_id',
        'categoria_id',
        'imagen_url' // Campo para la foto del producto
    ];

    // Relación con la tabla Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relación con la tabla Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
