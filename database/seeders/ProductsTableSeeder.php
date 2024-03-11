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

        for ($i = 0; $i < 100; $i++) {
            $category = DB::table('categories')->inRandomOrder()->first();
            $level = DB::table('levels')->inRandomOrder()->first();
            $status = DB::table('statuses')->inRandomOrder()->first();
            $unit = DB::table('units')->inRandomOrder()->first();
            $user = DB::table('users')->find(1);
            $description = $faker->sentence();

            Product::create([
                'productName' => $faker->sentence(3),
                'description' => substr($description, 0, 1400),
                'thumbnailImage' => $faker->imageUrl,
                'price' => $faker->randomFloat(2, 0, 1000),
                'discount' => $faker->randomFloat(2, 0, 1000),
                'code' => $faker->numerify('###'),
                'availableQuantity' => $faker->randomNumber(2),
                'minimumQuantity' => $faker->randomNumber(1),
                'expiration_date' => $faker->dateTimeBetween('now', '+1 year'),
                'view' => $faker->randomNumber,

                'category_id' => $category->id,
                'level_id' => $level->id,
                'status_id' => $status->id,
                'user_id' => $user->id,
                'unit_id' => $unit->id,
                'quantity' => $faker->randomNumber(2),
            ]);
        }
    }
}
