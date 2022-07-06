<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nome'=> 'Cliente',
            'email'=> 'cliente@hotmail.com',
            'senha'=> 'Cliente',
        ]);

        Usuario::create([
            'nome'=> 'Admin',
            'email'=> 'admin@hotmail.com',
            'senha'=> '12345678',
        ]);
    }
}
