<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Home', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image', 255);
            $table->longText('content_1');
            $table->longText('content_2');
            $table->longText('content_3');
            $table->longText('content_4');
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
        Schema::dropIfExists('Home');
    }
}
