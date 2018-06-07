<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('type');
            $table->integer('home_team')->nullable();
            $table->integer('away_team')->nullable();
            $table->integer('home_result')->nullable();
            $table->integer('away_result')->nullable();
            $table->dateTime('date');
            $table->dateTime('lock_time')->nullable();
            $table->integer('stadium_id');
            $table->integer('winning_team_id')->nullable();
            $table->boolean('finished')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
