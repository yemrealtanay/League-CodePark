<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'home_team_name',
        'home_team_score',
        'away_team_name',
        'away_team_score',
        'week'
    ];

    public function homeTeam()
    {
        return $this->hasMany(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->hasMany(Team::class, 'away_team_id');
    }

}
