<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
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

            Comment::create([
                'comment' => $faker->title,
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
