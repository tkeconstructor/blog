<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->text('questiontext');
            $table->boolean('shuffle');
            $table->integer('type_id')->unsigned();
            $table->integer('category_id')->unsigned();
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
        Schema::drop('questions');
    }
}
