<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nickname' => 'Tekken',
            'email' => 'ignatov0131@gmail.com',
            'password' => Hash::make('Gjgf1337@', ['rounds' => 12]),
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 3,
        ]);
    }
}
