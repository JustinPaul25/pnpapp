<?php

use App\Types\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => RoleType::POLICEADMIN]);
        Role::firstOrCreate(['name' => RoleType::BRGYADMIN]);
        Role::firstOrCreate(['name' => RoleType::COMPLAINANT]);
    }
}
