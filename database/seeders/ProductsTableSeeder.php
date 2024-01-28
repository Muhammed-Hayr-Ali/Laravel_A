<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *  'category_id',
     *  'levels',
     * 'brand'
     *  'name',
     *  'status',
     *  'description',
     *  'price',
     * 'unit', 'created By'
     *  'discountPercentage',
     *  'views',
     *
     *
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $category = DB::table('categories')
                ->inRandomOrder()
                ->first();
            $level = DB::table('levels')
                ->inRandomOrder()
                ->first();
            $status = DB::table('statuses')
                ->inRandomOrder()
                ->first();
            $brand = DB::table('brands')
                ->inRandomOrder()
                ->first();

            $unit = DB::table('units')
                ->inRandomOrder()
                ->first();

            $user = DB::table('users')->find(1);
            Product::create([
                'name' => $faker->sentence,
                'category_id' => $category->id,
                'level_id' => $level->id,
                'brand_id' => $brand->id,
                'unit_id' => $unit->id,
                'code' => $faker->numberBetween(111111, 999999),
                'minimum_Qty' => $faker->numberBetween(1, 24),
                'quantity' => $faker->numberBetween(12, 288),
                'expiration_date' => now()->addMonths(5),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.5, $max = 3999.9),
                'discount' => $faker->numberBetween(0, 50),
                'views' => $faker->numberBetween(0, 500),
                'status_id' => $status->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
