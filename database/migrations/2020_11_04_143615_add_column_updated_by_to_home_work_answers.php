<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUpdatedByToHomeWorkAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_work_answers', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
            $table->integer('marks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_work_answers', function (Blueprint $table) {
            //
        });
    }
}
