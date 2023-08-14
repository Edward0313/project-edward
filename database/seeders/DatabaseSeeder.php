<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Product::create(['title' => '測試資料', 'content' => '測試內容', 'price' => rand(0, 300), 'quantity' => 10]);
        Product::create(['title' => '測試資料2', 'content' => '測試內容', 'price' => rand(0, 300), 'quantity' => 10]);
        Product::create(['title' => '測試資料3', 'content' => '測試內容', 'price' => rand(0, 300), 'quantity' => 10]);

        $this->call(ProductSeeder::class);
        $this->command->info('Product table seeded!');
    }
}
