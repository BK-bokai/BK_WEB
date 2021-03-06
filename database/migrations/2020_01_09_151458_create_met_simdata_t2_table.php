<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetSimdataT2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('met_simdata_t2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Filename', 255);
            $table->string('Path', 255);
            $table->string('year', 255);
            $table->string('month', 255);
            $table->string('day', 255);
            $table->string('date', 255);
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
        Schema::dropIfExists('met_simdata_t2');
    }
}
