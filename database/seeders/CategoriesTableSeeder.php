<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'name'
     * 'url'
     */
    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 12; $i++) {

            Category::create([
                'name' => $faker->word,
                'url'=>  $faker->imageUrl,
           ]);
    }
}
}