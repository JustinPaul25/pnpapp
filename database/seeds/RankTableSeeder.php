<?php

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rank::create([
            'rank' => 'Police General'
        ]);

        Rank::create([
            'rank' => 'Police Lieutenant General'
        ]);

        Rank::create([
            'rank' => 'Police Major General'
        ]);

        Rank::create([
            'rank' => 'Police Brigadier General'
        ]);

        Rank::create([
            'rank' => 'Police Colonel'
        ]);

        Rank::create([
            'rank' => 'Police Lieutenant Colonel'
        ]);

        Rank::create([
            'rank' => 'Police Major'
        ]);

        Rank::create([
            'rank' => 'Police Captain'
        ]);

        Rank::create([
            'rank' => 'Police Lieutenant'
        ]);

        Rank::create([
            'rank' => 'Police Executive Master Sergeant'
        ]);

        Rank::create([
            'rank' => 'Police Senior Master Sergeant'
        ]);

        Rank::create([
            'rank' => 'Police Master Sergeant'
        ]);

        Rank::create([
            'rank' => 'Police Staff Master Sergeant'
        ]);

        Rank::create([
            'rank' => 'Police Corporal'
        ]);

        Rank::create([
            'rank' => 'Patrolman/Patrolwoman'
        ]);
    }
}
