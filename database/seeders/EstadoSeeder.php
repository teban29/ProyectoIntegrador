<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        $estados = ['Pendiente', 'Confirmada', 'Cancelada', 'Completada'];

        foreach ($estados as $nombre) {
            Estado::create(['nombre' => $nombre]);
        }
    }
}
