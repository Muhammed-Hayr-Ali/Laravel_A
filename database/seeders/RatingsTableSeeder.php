<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *   'rating'
     *    'user_id'
     *    'product_id'
     * 
     * 
     */
    public function run(): void
    {
        
        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {

            $user = DB::table('users')->inRandomOrder()->first();
            $product = DB::table('products')->inRandomOrder()->first();

            Rating::create([
                'rating' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0.0, $max = 5.0),
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
