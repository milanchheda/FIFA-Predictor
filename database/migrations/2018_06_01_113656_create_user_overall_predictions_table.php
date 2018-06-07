<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOverallPredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_overall_predictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('prediction_id');
            $table->integer('user_predicted_id');
            $table->integer('points_obtained')->nullable();
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
        Schema::dropIfExists('user_overall_predictions');
    }
}
