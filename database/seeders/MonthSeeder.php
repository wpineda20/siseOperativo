<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Month;

class MonthSeeder extends Seeder
{
    /**
     * Run the Month
     *
     * @return void
     */
    public function run()
    {
        Month::insert([
            [
                'id' => 1,
                'month_name' => 'Enero',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'month_name' => 'Febrero',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'month_name' => 'Marzo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'month_name' => 'Abril',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'month_name' => 'Mayo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'month_name' => 'Junio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'month_name' => 'Julio',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'month_name' => 'Agosto',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'month_name' => 'Septiembre',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'month_name' => 'Octubre',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'month_name' => 'Noviembre',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'month_name' => 'Diciembre',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
