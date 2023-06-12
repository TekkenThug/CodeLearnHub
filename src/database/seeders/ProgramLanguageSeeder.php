<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramLanguageSeeder extends Seeder
{
    private $languages = [
        'JavaScript',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->languages as $language)
        {
            DB::table('program_languages')->insert([
                'name' => $language,
            ]);
        }
    }
}
