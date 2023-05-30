<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now();
        
        DB::table('news')->insert([
            'title' => 'Версия v.0.1.0',
            'text' => 'Первый патч вышел!',
            'created_at' => $currentDate,
        ]);

        DB::table('news')->insert([
            'title' => 'Версия v.0.1.1',
            'text' => 'Второй патч вышел!',
            'created_at' => $currentDate,
        ]);
    }
}
