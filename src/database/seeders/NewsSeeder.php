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
            'text' => '<p>Первая версия сайта.</p>Добавлены следующие возможности: <ul><li>Регистрация/вход</li><li>Поиск курсов</li><li>Загрузка аватара в личный профить</li></ul>',
            'added_at' => $currentDate,
        ]);

        sleep(3);

        $currentDate = Carbon::now();
        DB::table('news')->insert([
            'title' => 'Добавление первых языков',
            'text' => 'Добавлены следующие языки: <ul><li>JavaScript</li><li>PHP</li></ul>',
            'added_at' => $currentDate,
        ]);
    }
}
