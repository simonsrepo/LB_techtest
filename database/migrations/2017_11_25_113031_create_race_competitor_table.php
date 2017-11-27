<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceCompetitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_competitor', function (Blueprint $table) {
            $table->integer('race_id');
            $table->integer('competitor_id');
            $table->tinyInteger('position');
            $table->timestamps();
            $table->index(['race_id', 'competitor_id']);
            $table->unique(['race_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_competitor');
    }
}
