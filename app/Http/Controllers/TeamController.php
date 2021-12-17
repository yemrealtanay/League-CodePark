<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Table;
use App\Models\Team;
use App\Services\PlayGame;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function index()
    {
        $weeklyFixtures = Fixture::all()->groupBy('week')->sortByDesc('week');

        $weeklyTables = Table::all()->groupBy('week')->sortByDesc('week')->sortBy('p');

        return view('table.index', compact('weeklyFixtures', 'weeklyTables'));
    }

    public function next_week()
    {
        $teams = Team::all();
        $fixtures = Fixture::all();
        $playGame = new PlayGame();
        $playGame->next_week($teams);

        $weeklyFixtures = Fixture::all()->groupBy('week')->sortByDesc('week');
        $weeklyTables = Table::all()->groupBy('week')->sortByDesc('week');
        return view('table.index', compact('weeklyFixtures', 'weeklyTables'));
    }
}
