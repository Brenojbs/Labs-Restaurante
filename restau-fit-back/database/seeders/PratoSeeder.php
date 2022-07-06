<?php

namespace Database\Seeders;

use App\Models\Prato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prato::create([
            'nome'=> 'Carne frita',
            'categoria'=> 'Frito',
            'imagem'=> 'https://www.google.image/não-sei-onde-pegar-a-imagem-correta',
            'preço'=> 15,
        ]);
        Prato::create([
            'nome'=> 'Carne assada',
            'categoria'=> 'Assado',
            'imagem'=> 'https://www.google.image/não-sei-onde-pegar-a-imagem-correta',
            'preço'=> 15,
        ]);
        Prato::create([
            'nome'=> 'Carne cozida',
            'categoria'=> 'Cozido',
            'imagem'=> 'https://www.google.image/não-sei-onde-pegar-a-imagem-correta',
            'preço'=> 15,
        ]);
    }
}
