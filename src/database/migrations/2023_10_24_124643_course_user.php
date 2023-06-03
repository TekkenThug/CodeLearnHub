<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->primary(['user_id', 'course_id']);

            $table->unsignedInteger('rate')->nullable();

            $table->unsignedBigInteger('current_module_id');
            $table->unsignedBigInteger('current_lesson_id');

            $table->foreign('current_module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('current_lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            
            $table->boolean('is_complete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_course');
    }
};
