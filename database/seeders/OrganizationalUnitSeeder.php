<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationalUnit;

class OrganizationalUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationalUnit::insert([
            [
                'id' => 1,
                'ou_name' => 'Unidad de Talento Humano',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'ou_name' => 'Unidad de Informatica y Sistemas',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'ou_name' => 'Unidad de Adquisiciones y Contrataciones Institucional',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'ou_name' => 'Unidad de Mantenimiento',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'ou_name' => 'Unidad de Gestión Documental y Archivos',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'ou_name' => 'Unidad de Logística',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'ou_name' => 'Unidad de Acceso a la información Pública',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'ou_name' => 'Unidad de Activo Fijo',
                'direction_id' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
