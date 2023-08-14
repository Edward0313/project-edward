<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert([
        [
            'id' => 7,
            'title' => '固定資料',
            'content' => '固定內容',
            'price' => rand(0, 300),
            'quantity' => 10
        ],
        [
            'id' => 8,
            'title' => '固定資料2',
            'content' => '固定內容2',
            'price' => rand(0, 300),
            'quantity' => 10
        ]
        ], ['id'], ['price', 'quantity']);
        
        // Product::create(['title' => '測試資料', 'content' => '測試內容', 'price' => rand(0, 300), 'quantity' => 10]);
    }
}
