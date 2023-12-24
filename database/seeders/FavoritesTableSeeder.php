<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {

            $user = DB::table('users')->inRandomOrder()->first();
            $product = DB::table('products')->inRandomOrder()->first();

            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
