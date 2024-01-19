<?php

namespace Database\Seeders;

use App\Models\ProductOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            $product = DB::table('products')
                ->inRandomOrder()
                ->first();
            $order = DB::table('orders')
                ->inRandomOrder()
                ->first();

            ProductOrder::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'quantity' => $faker->numberBetween(1, 48),
                'price' => $faker->numberBetween(100, 500),
            ]);
        }
    }
}
