<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->text('desc');
            $table->boolean('shuffle');
            $table->boolean('auto_activate');
            $table->timestamp('timeopen');
            $table->integer('timelimit');
            $table->text('quiz_parts');
            $table->integer('course_id')->unsigned();
            $table->integer('createdby')->unsigned();
            $table->integer('modifiedby')->unsigned();
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
        Schema::drop('quizs');
    }
}
