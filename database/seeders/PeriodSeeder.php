<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Period;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::insert([
            [
                'id' => 1,
                'period_name' => '2020 - 2025',
                'start_year' => 2020,
                'end_year' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
