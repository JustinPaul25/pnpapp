<?php

use App\Models\CaseStatus;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CaseStatus::create([
            'status' => 'Pending'
        ]);

        CaseStatus::create([
            'status' => 'Discard'
        ]);
        
        CaseStatus::create([
            'status' => 'Solved'
        ]);
    }
}
