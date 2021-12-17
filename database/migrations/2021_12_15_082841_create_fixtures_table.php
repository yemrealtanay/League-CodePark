<?php

use App\Models\Team;
use App\Models\Week;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'home_team_id');
            $table->string('home_team_name');
            $table->foreignIdFor(Team::class, 'away_team_id');
            $table->string('away_team_name');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->integer('week')->default(0);
            $table->timestamps();

            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('away_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
}
