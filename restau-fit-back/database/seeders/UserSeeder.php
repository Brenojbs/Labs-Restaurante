<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nome'=> 'Cliente',
            'email'=> 'cliente@hotmail.com',
            'categoria'=> 'cliente',
            'password'=> '$2y$10$7Wjrdk0R/xx6gD7VN.n0uOrOFMw17BoIJU5nNRDllgqT/XlM8YoNS',
        ]);

        User::create([
            'nome'=> 'Admin',
            'email'=> 'admin@hotmail.com',
            'categoria'=> 'admin',
            'password'=> '$2y$10$HEvi0AcOjT2gj49t563LJurhVoDLbv.1z3jFjn6PYdbWeIZ8wntv2',
        ]);
    }
}
