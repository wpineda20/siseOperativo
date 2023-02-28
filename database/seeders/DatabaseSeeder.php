<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            TrakingStatusSeeder::class,
            InstitutionSeeder::class,
            DirectionSeeder::class,
            OrganizationalUnitSeeder::class,
            PeriodSeeder::class,
            UnitSeeder::class,
            IndicatorSeeder::class,
            MonthSeeder::class,
            YearSeeder::class,
            UserSeeder::class,
            MonthlyClosingSeeder::class,
            CronClosingSeeder::class,
        ]);
    }
}
