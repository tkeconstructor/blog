<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameLecturerToUserIdOnCourseAttempt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_attempt', function (Blueprint $table) {
            $table->renameColumn('lecturer','user_id');
        });

        Schema::rename('course_attempt','course_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_attempt', function (Blueprint $table) {
            $table->renameColumn('user_id','lecturer');
        });

        Schema::rename('course_user','course_attempt');
    }
}
