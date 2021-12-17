<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Team;
use App\Services\PlayGame;
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
        $team1 = new Team();
        $team1->name = 'Arsenal';
        $team1->strength = rand(1, 100);
        $team1->save();
        $team2 = new Team();
        $team2->name = 'Chelsea';
        $team2->strength = rand(1, 100);
        $team2->save();
        $team3 = new Team();
        $team3->name = 'Liverpool';
        $team3->strength = rand(1, 100);
        $team3->save();
        $team4 = new Team();
        $team4->name = 'Manchester City';
        $team4->strength = rand(1, 100);
        $team4->save();
        $teams = Team::all();
        $set = new PlayGame();
        $set->set_matches($teams);
        $set->set_tables($teams);


    }
}
