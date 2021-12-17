<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'team_id');
            $table->string('team_name');
            $table->integer('week')->default(0);
            $table->integer('pts')->default(0);
            $table->integer('p')->default(0);
            $table->integer('w')->default(0);
            $table->integer('d')->default(0);
            $table->integer('l')->default(0);
            $table->integer('gd')->default(0);
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
