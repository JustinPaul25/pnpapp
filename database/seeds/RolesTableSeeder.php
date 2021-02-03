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
        Role::firstOrCreate(['name' => RoleType::ADMINISTRATOR]);
        Role::firstOrCreate(['name' => RoleType::POLICE]);
        Role::firstOrCreate(['name' => RoleType::BRGYPOLICE]);
        Role::firstOrCreate(['name' => RoleType::NORMALUSER]);
    }
}
