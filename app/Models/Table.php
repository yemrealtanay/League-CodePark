<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'team_name', 'week', 'pts', 'p', 'w', 'd', 'l', 'gd'];

    public function team(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class);
    }

}
