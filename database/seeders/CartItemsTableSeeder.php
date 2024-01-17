<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {

            $carts = DB::table('carts')->inRandomOrder()->first();
            $product = DB::table('products')->inRandomOrder()->first();

            CartItem::create([
                'cart_id' => $carts->id,
                'product_id' => $product->id,
                'quantity' => $faker->numberBetween(1, 10),
                
            ]);
        }
    }
}
