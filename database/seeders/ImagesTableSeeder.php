<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *  'name',
     *  'url',
     *  'product_id',
     */
    public function run(): void
    {
        
        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {

            $product = DB::table('products')->inRandomOrder()->first();

            Image::create([
                'name' => $faker->title,
                'url' => $faker->imageUrl,
                'product_id' => $product->id,
            ]);
        }
    }
}
