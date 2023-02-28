<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Indicator::insert([
            [
                'id' => 1,
                'indicator_name' => 'Indicator Uno',
                // 'strategic_indicator' => 'SI',
                // 'institution_id' => 1,
                // 'unit_id' => 1,
                // 'organizational_unit_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
