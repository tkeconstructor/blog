<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAttemptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempt', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('timestart');
            $table->timestamp('timefinish');
            $table->integer('student_id')->unsigned();
            $table->integer('quiz_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_attempt');
    }
}
