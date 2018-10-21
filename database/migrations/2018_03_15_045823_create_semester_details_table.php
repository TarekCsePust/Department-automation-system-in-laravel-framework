<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');
            $table->integer('semesterId');
            $table->string('startingDate');
            $table->string('endingDate');
            $table->integer('resultPublish')->default(0);
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
        Schema::dropIfExists('semester_details');
    }
}
