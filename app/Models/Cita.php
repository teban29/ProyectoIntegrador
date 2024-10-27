<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = ['servicio_id', 'fecha', 'hora', 'barbero_id', 'cliente_id'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function barbero()
    {
        return $this->belongsTo(Usuario::class, 'barbero_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id');
    }
}
