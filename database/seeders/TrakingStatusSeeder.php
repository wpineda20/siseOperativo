<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrackingStatus;

class TrakingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrackingStatus::insert([
            [
                'id' => 1,
                'status_name' => 'En proceso',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'status_name' => 'Atrasado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'status_name' => 'Completado',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
