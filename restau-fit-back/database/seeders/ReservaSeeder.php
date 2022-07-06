<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reserva::create([
            'nome'=> 'Cliente Que Não Compra',
            'data'=> '25/01/2023',
        ]);
        Reserva::create([
            'nome'=> 'Cliente Que Compra',
            'data'=> '26/01/2023',
        ]);
    }
}
