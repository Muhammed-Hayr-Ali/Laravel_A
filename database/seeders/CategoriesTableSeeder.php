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
     * 'description'
     * 'image'
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = ['unclassified', 'Electronic', 'Phone', 'Car', 'Motorcycle', 'Furniture', 'Book', 'Belongings', 'Food', 'Real estate', 'Services', 'Houseware', 'Animal', 'Clothes'];
        foreach ($categories as $key => $category) {
            Category::create([
                'name' => $category,
                'description' => $faker->text($maxNbChars = 46),
                'image' => $faker->imageUrl,
            ]);
        }
    }
}
