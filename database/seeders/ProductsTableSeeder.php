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
     *  'name',
     *  'status',
     *  'description',
     *  'price',
     *  'discountPercentage',
     *  'views',
     * 
     * 
     */
    public function run(): void
    {
       
        
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
        $category = DB::table('categories')->inRandomOrder()->first(); 

            Product::create([
                'name' => $faker->sentence,
                'status' =>  $faker->randomElement(['available', 'Unavailable', 'limited quantity']),
                'description'=> $faker->paragraph,
                'price'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 0.5, $max = 3999.9),
                'discountPercentage'=> $faker->numberBetween(0,50),
                'views'=>  $faker->numberBetween(0,500),
                'category_id'  => $category->id,
           ]);
        }
    }
}
