<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('kick_off');
            $table->string('home_team');
            $table->string('away_team');
            $table->string('home_team_iso');
            $table->string('away_team_iso');
            $table->string('venue');
            $table->boolean('played');
            $table->integer('home_score');
            $table->integer('away_score');
            $table->integer('goal_diff');
            $table->boolean('home_win');
            $table->boolean('away_win');
            $table->boolean('draw');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matches');
    }
}
