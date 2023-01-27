<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Skirt',
            'size' => 'XS',
            'count' => 5,
        ]);

        Product::create([
            'name' => 'T-shirt',
            'size' => 'L',
            'count' => 12,
        ]);
    }
}
