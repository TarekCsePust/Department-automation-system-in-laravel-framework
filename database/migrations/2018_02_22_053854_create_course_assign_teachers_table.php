<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAssignTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_assign_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courseId');
            $table->integer('internalTeacherId')->default(0);
            $table->integer('externalTeacherId')->default(0);
            $table->string('IQS')->default("No");
            $table->string('EQS')->default("No");
            $table->string('IQA')->default("No");
            $table->string('EQA')->default("No");
            $table->integer('sessionAssignCourseId');
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
        Schema::dropIfExists('course_assign_teachers');
    }
}
