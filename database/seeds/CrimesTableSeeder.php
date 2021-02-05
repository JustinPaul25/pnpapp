<?php

use App\Models\Crime;
use Illuminate\Database\Seeder;

class CrimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crime::create([
            'type' => 'Focus Crimes'
        ]);

        Crime::create([
            'type' => 'Drug Related Incidents'
        ]);

        Crime::create([
            'type' => 'End Local Communist Armed Conflict (ELCAC)'
        ]);

        Crime::create([
            'type' => 'Missing persons'
        ]);

        Crime::create([
            'type' => 'Most wanted individuals'
        ]);
        
        Crime::create([
            'type' => 'Lost and found items'
        ]);
    }
}
