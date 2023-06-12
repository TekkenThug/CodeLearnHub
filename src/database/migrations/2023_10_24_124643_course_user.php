<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        DB::unprepared('
            CREATE TRIGGER calculate_average_rate_insert
            AFTER INSERT ON course_user
            FOR EACH ROW
            BEGIN
                DECLARE avg_rate DECIMAL(10, 2);
                
                -- Вычисление среднего значения поля rate из таблицы course_user
                SELECT AVG(rate) INTO avg_rate FROM course_user WHERE course_id = NEW.course_id;
                
                -- Обновление поля average_rate в таблице courses
                UPDATE courses SET rate = IFNULL(avg_rate, 0) WHERE id = NEW.course_id;
            END;

            CREATE TRIGGER calculate_average_rate_update
            AFTER UPDATE ON course_user
            FOR EACH ROW
            BEGIN
                DECLARE avg_rate DECIMAL(10, 2);
                
                -- Вычисление среднего значения поля rate из таблицы course_user
                SELECT AVG(rate) INTO avg_rate FROM course_user WHERE course_id = NEW.course_id;
                
                -- Обновление поля average_rate в таблице courses
                UPDATE courses SET rate = IFNULL(avg_rate, 0) WHERE id = NEW.course_id;
            END;

            CREATE TRIGGER calculate_average_rate_delete
            AFTER DELETE ON course_user
            FOR EACH ROW
            BEGIN
                DECLARE avg_rate DECIMAL(10, 2);
                
                -- Вычисление среднего значения поля rate из таблицы course_user
                SELECT AVG(rate) INTO avg_rate FROM course_user WHERE course_id = OLD.course_id;
                
                -- Обновление поля average_rate в таблице courses
                UPDATE courses SET rate = IFNULL(avg_rate, 0) WHERE id = OLD.course_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_user');
    }
};
