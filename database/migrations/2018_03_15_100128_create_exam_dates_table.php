<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');
            $table->integer('semesterId');
            $table->string('startingDate');
            $table->string('endingDate');
            $table->string('examType');
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
        Schema::dropIfExists('exam_dates');
    }
}
