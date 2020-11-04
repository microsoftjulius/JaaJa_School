<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeWorkMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('teacher_id');
            $table->integer('school_id');
            $table->integer('home_work_id');
            $table->string('marks');
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
        Schema::dropIfExists('home_work_marks');
    }
}
