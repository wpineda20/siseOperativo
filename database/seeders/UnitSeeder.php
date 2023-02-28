<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::insert([
            [
                'id' => 1,
                'unit_name' => 'Anual',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'unit_name' => 'Mensual',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'unit_name' => 'Semanal',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
