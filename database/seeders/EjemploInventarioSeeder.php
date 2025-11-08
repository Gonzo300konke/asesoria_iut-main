<?php

namespace Database\Seeders;

use App\Models\Organismo;
use App\Models\UnidadAdministradora;
use App\Models\Dependencia;
use App\Models\Bien;
use App\Models\Usuario;
use App\Models\Responsable;
use App\Models\TipoResponsable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EjemploInventarioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Tipo de Responsable
        $tipoResponsable = TipoResponsable::firstOrCreate(
            ['nombre' => 'Responsable Patrimonial'],
            ['nombre' => 'Responsable Patrimonial']
        );

        // 2. Crear Organismo
        $organismo = Organismo::firstOrCreate(
            ['codigo' => 'MPPEU'],
            ['nombre' => 'MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA']
        );

        // 3. Crear Unidad Administradora
        $unidad = UnidadAdministradora::firstOrCreate(
            ['codigo' => '1430'],
            ['organismo_id' => $organismo->id, 'nombre' => 'UPTOS "CLODOSBALDO RUSSIAN"']
        );

        // 4. Crear Dependencia
        $dependencia = Dependencia::firstOrCreate(
            ['codigo' => '0', 'unidad_administradora_id' => $unidad->id],
            ['nombre' => 'DEPENDENCIA USUARIA']
        );

        // 5. Crear Responsable Patrimonial Primario
        $responsablePrimario = Responsable::firstOrCreate(
            ['cedula' => '3873777'],
            ['tipo_id' => $tipoResponsable->id, 'nombre' => 'ENRY GÓMEZ MAIZ', 'correo' => 'enry.gomez@edu.ve']
        );

        // 6. Crear Usuario Administrador
        $usuarioAdmin = Usuario::firstOrCreate(
            ['correo' => 'enry.gomez@edu.ve'],
            ['rol_id' => 1, 'cedula' => '3873777', 'nombre' => 'ENRY GÓMEZ MAIZ', 'hash_password' => Hash::make('Admin123'), 'activo' => true]
        );

        // 7. Crear algunos bienes de ejemplo
        $bienes = [
            [
                'codigo' => 'BN-2024-001',
                'descripcion' => 'Computadora de Escritorio Dell',
                'dependencia_id' => $dependencia->id,
                'responsable_id' => $responsablePrimario->id,
                'ubicacion' => 'Oficina 101',
                'estado' => 'ACTIVO',
                'fecha_registro' => '2024-01-15',
            ],
            [
                'codigo' => 'BN-2024-002',
                'descripcion' => 'Impresora Multifunción HP',
                'dependencia_id' => $dependencia->id,
                'responsable_id' => $responsablePrimario->id,
                'ubicacion' => 'Sala de Copias',
                'estado' => 'ACTIVO',
                'fecha_registro' => '2024-01-20',
            ],
            [
                'codigo' => 'BN-2024-003',
                'descripcion' => 'Escritorio de Metal',
                'dependencia_id' => $dependencia->id,
                'responsable_id' => $responsablePrimario->id,
                'ubicacion' => 'Oficina 102',
                'estado' => 'ACTIVO',
                'fecha_registro' => '2024-02-01',
            ],
            [
                'codigo' => 'BN-2024-004',
                'descripcion' => 'Sillas ergonómicas (5 unidades)',
                'dependencia_id' => $dependencia->id,
                'responsable_id' => $responsablePrimario->id,
                'ubicacion' => 'Sala de Reuniones',
                'estado' => 'ACTIVO',
                'fecha_registro' => '2024-02-10',
            ],
            [
                'codigo' => 'BN-2024-005',
                'descripcion' => 'Monitor LG 27 pulgadas',
                'dependencia_id' => $dependencia->id,
                'responsable_id' => $responsablePrimario->id,
                'ubicacion' => 'Oficina 101',
                'estado' => 'ACTIVO',
                'fecha_registro' => '2024-02-15',
            ],
        ];

        foreach ($bienes as $bien) {
            Bien::create($bien);
        }

        $this->command->info('✓ Ejemplo de inventario creado exitosamente');
        $this->command->line('');
        $this->command->info('Datos creados:');
        $this->command->line('├─ Organismo: ' . $organismo->nombre);
        $this->command->line('├─ Unidad: ' . $unidad->nombre);
        $this->command->line('├─ Dependencia: ' . $dependencia->nombre);
        $this->command->line('├─ Responsable: ' . $responsablePrimario->nombre);
        $this->command->line('├─ Usuario: ' . $usuarioAdmin->nombre);
        $this->command->line('└─ Bienes: ' . count($bienes) . ' artículos');
        $this->command->line('');
        $this->command->info('Puede iniciar sesión con:');
        $this->command->line('Email: ' . $usuarioAdmin->correo);
        $this->command->line('Contraseña: Admin123');
    }
}
