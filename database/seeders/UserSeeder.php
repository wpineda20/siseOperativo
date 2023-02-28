<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::findOrFail(1);
        $roleEnlace = Role::findOrFail(2);
        $roleAuditor = Role::findOrFail(3);

        $admin = User::create([
            'id' => 1,
            'user_name' => 'wpineda',
            'name' => 'William Pineda',
            'job_title' => 'Técnico',
            'phone' => '0000-0000',
            'organizational_units_id' => 2,
            'email' => 'wpineda@cultura.gob.sv',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole($roleAdmin);
    }
}
