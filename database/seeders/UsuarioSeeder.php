<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run(): void
{
    Usuario::create([
        'rol_id' => 1,
        'cedula' => '12345678',
        'nombre' => 'Admin',
        'correo' => 'admin@example.com',
        'hash_password' => bcrypt('admin123'),
        'activo' => true,
    ]);
}
}
