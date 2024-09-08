<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsStartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Черный металл',
            'price_buy' => '5',
            'price_sell' => '8',
            'price_discount' => '6',
            'weight_discount' => '100',
            'dirt' => '1',
            'count' => '0',
            'slug' => 'chernyy-metall',
            'is_published' => 'on',
            'images' => 'chernyy-metall.png',
        ]);

        Product::create([
            'name' => 'Аллюминий',
            'price_buy' => '25',
            'price_sell' => '30',
            'price_discount' => '26',
            'weight_discount' => '100',
            'dirt' => '0',
            'count' => '0',
            'slug' => 'alyuminiy',
            'is_published' => 'on',
            'images' => 'allyuminiy.png',
        ]);

        Product::create([
            'name' => 'Медь',
            'price_buy' => '35',
            'price_sell' => '38',
            'price_discount' => '36',
            'weight_discount' => '100',
            'dirt' => '0',
            'count' => '0',
            'slug' => 'med',
            'is_published' => 'on',
            'images' => 'med.png',
        ]);

        Product::create([
            'name' => 'Деловой металл',
            'price_buy' => '0',
            'price_sell' => '0',
            'price_discount' => '0',
            'weight_discount' => '0',
            'dirt' => '0',
            'count' => '0',
            'slug' => 'delovoy-metall',
            'is_published' => 'on',
            'images' => 'delovoy-metall.png',
        ]);
    }
}
