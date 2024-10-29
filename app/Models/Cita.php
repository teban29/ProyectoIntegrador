<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'fecha',
        'hora',
        'servicio_id',
        'cliente_id',
        'barbero_id',
    ];

    //relacion con servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    //relacion con cliente
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
    
    //relacion con barbero
    public function barbero()
    {
        return $this->belongsTo(Usuario::class, 'barbero_id');
    }


}