<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direction::insert([
            [
                "id" => 1,
                "direction_name" => "Dirección General Financiera Institucional",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 2,
                "direction_name" => "Dirección General de Multiculturalidad",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 3,
                "direction_name" => "Dirección General de Género y Diversidad",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 4,
                "direction_name" => "Dirección General de Género y Diversidad",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 5,
                "direction_name" => "Dirección General de Comunicaciones Institucionales",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 6,
                "direction_name" => "Dirección General de Relaciones Internacionales y Cooperación",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 7,
                "direction_name" => "Dirección General Ambiental",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 8,
                "direction_name" => "Dirección General de Planificación y Desarrollo Institucional",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 9,
                "direction_name" => "Dirección General de Proyectos de Inversión",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 10,
                "direction_name" => "Dirección General de Auditoría Interna",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],
            [
                "id" => 11,
                "direction_name" => "Dirección General de Administración",
                'institution_id' => 1,
                'created_at' => now(),
                "created_at" => now(),
            ],

        ]);
    }
}
