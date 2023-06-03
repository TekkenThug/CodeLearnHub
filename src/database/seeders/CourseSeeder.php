<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'Курс по PHP',
            'description' => 'Основы PHP - языка backend',
            'cover' => 'https://www.php.net/images/meta-image.png',
            'program_language_id' => 1,
            'students_count' => 472,
            'is_active' => true
        ]);

        DB::table('courses')->insert([
            'name' => 'Курс по JavaScript',
            'description' => 'Frontend разработка',
            'students_count' => 241,
            'cover' => 'https://i.pinimg.com/originals/7a/fb/04/7afb0491c91b2f9e9aac56667c3be677.jpg',
            'program_language_id' => 2,
            'is_active' => true
        ]);

        DB::table('courses')->insert([
            'name' => 'Курс по Python',
            'description' => 'Основы популярного языка',
            'students_count' => 339,
            'cover' => 'https://images.hdqwalls.com/wallpapers/python-logo-4k-i6.jpg',
            'program_language_id' => 3,
            'is_active' => true
        ]);
    }
}
