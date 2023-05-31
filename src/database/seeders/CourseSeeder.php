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
        ]);

        DB::table('courses')->insert([
            'name' => 'Курс по Java',
            'description' => 'ООП для чайников',
            'students_count' => 4,
            'cover' => 'https://static.vecteezy.com/system/resources/previews/020/111/553/original/java-editorial-logo-free-download-free-vector.jpg',
            'program_language_id' => 2,
        ]);
    }
}
