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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('cover');
            $table->unsignedBigInteger('program_language_id');
            $table->foreign('program_language_id')->references('id')->on('program_languages')->onDelete('cascade');
            $table->double('rate')->default(0);
            $table->unsignedInteger('lessons_count')->default(0);
            $table->unsignedInteger('students_count')->default(0);
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('courses');
    }
};
