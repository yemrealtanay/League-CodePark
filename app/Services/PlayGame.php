<?php

namespace App\Services;

use App\Models\Fixture;
use App\Models\Table;
use App\Models\Team;

class PlayGame
{

    public function set_matches($teams)
    {
        $fixture = new Fixture();
        $fixture->week = 1;
        $fixture->home_team_id = $teams[0]->id;
        $fixture->home_team_name = $teams[0]->name;
        $fixture->away_team_id = $teams[1]->id;
        $fixture->away_team_name = $teams[1]->name;
        $fixture->save();
        $fixture = new Fixture();
        $fixture->week = 1;
        $fixture->home_team_id = $teams[2]->id;
        $fixture->home_team_name = $teams[2]->name;
        $fixture->away_team_id = $teams[3]->id;
        $fixture->away_team_name = $teams[3]->name;
        $fixture->save();
        $fixture = new Fixture();
        $fixture->week = 2;
        $fixture->home_team_id = $teams[0]->id;
        $fixture->home_team_name = $teams[0]->name;
        $fixture->away_team_id = $teams[2]->id;
        $fixture->away_team_name = $teams[2]->name;
        $fixture->save();
        $fixture = new Fixture();
        $fixture->week = 2;
        $fixture->home_team_id = $teams[1]->id;
        $fixture->home_team_name = $teams[1]->name;
        $fixture->away_team_id = $teams[3]->id;
        $fixture->away_team_name = $teams[3]->name;
        $fixture->save();
        $fixture = new Fixture();
        $fixture->week = 3;
        $fixture->home_team_id = $teams[3]->id;
        $fixture->home_team_name = $teams[3]->name;
        $fixture->away_team_id = $teams[0]->id;
        $fixture->away_team_name = $teams[0]->name;
        $fixture->save();
        $fixture = new Fixture();
        $fixture->week = 3;
        $fixture->home_team_id = $teams[2]->id;
        $fixture->home_team_name = $teams[2]->name;
        $fixture->away_team_id = $teams[1]->id;
        $fixture->away_team_name = $teams[1]->name;
        $fixture->save();
    }

    public function set_tables($teams)
    {
        for ($i = 0; $i < count($teams); $i++) {
            $table = new Table();
            $table->team_id = $teams[$i]->id;
            $table->team_name = $teams[$i]->name;
            $table->pts = 0;
            $table->p = 0;
            $table->w = 0;
            $table->d = 0;
            $table->l = 0;
            $table->gd = 0;
            $table->save();
        }
    }

    private function updateTeamWin($table)
    {
        $table->update([
            'pts' => $table->pts + 3,
            'w' => $table->w + 1,
            'p' => $table->p + 1
        ]);

    }

    private function updateTeamDraw($table)
    {
        $table->update([
            'pts' => $table->pts + 1,
            'd' => $table->d + 1,
            'p' => $table->p + 1
        ]);
    }

    private function updateTeamLose($table)
    {
        $table->update([
            'l' => $table->l + 1,
            'p' => $table->p + 1
        ]);
    }

    public function next_week($teams)
    {
        $newWeek = Table::orderBy('week', 'desc')->first()->week + 1;
        $fixtures = Fixture::where('week', $newWeek)->get();
        $fixtures->each(function ($fixture) use ($newWeek) {
            $team1 = Team::find($fixture->home_team_id);
            $team2 = Team::find($fixture->away_team_id);
            $team1LastTable = Table::where('team_id', $team1->id)->orderBy('week', 'desc')->first();
            $team2LastTable = Table::where('team_id', $team2->id)->orderBy('week', 'desc')->first();
            $table1 = new Table();
            $table1->team_id = $team1->id;
            $table1->team_name = $team1->name;
            $table1->pts = $team1LastTable->pts;
            $table1->p = $team1LastTable->p;
            $table1->w = $team1LastTable->w;
            $table1->d = $team1LastTable->d;
            $table1->l = $team1LastTable->l;
            $table1->gd = $team1LastTable->gd;
            $table1->week = $newWeek;
            $table1->save();
            $table2 = new Table();
            $table2->team_id = $team2->id;
            $table2->team_name = $team2->name;
            $table2->pts = $team2LastTable->pts;
            $table2->p = $team2LastTable->p;
            $table2->w = $team2LastTable->w;
            $table2->d = $team2LastTable->d;
            $table2->l = $team2LastTable->l;
            $table2->gd = $team2LastTable->gd;
            $table2->week = $newWeek;
            $table2->save();
            $this->playMatch($team1, $team2, $table1, $table2, $fixture);
        });
    }

    private function playMatch($team1, $team2, $table1, $table2, $fixture)
    {
        if ($team1->strength > $team2->strength) {
            $fixture->home_score = rand(1, 5);
            $fixture->away_score = rand(0, 3);
            $fixture->save();
        } else{
            $fixture->home_score = rand(0, 3);
            $fixture->away_score = rand(1, 5);
            $fixture->save();
        }
        if ($fixture->home_score > $fixture->away_score) {
            $this->updateTeamWin($table1);
            $this->updateTeamLose($table2);
            $table1->update([
                'gd' => $table1->gd + $fixture->home_score - $fixture->away_score
            ]);
        } elseif ($fixture->home_score < $fixture->away_score) {
            $this->updateTeamWin($table2);
            $this->updateTeamLose($table1);
            $table2->update([
                'gd' => $table2->gd + $fixture->away_score - $fixture->home_score
            ]);
        } else {
            $this->updateTeamDraw($table2);
            $this->updateTeamDraw($table1);
        }
    }
}
