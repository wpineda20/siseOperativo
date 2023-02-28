<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonthlyClosing;

class MonthlyClosingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthlyClosing::insert([
            [
                'id' => 1,
                'year_id' =>  4,
                'closing_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
