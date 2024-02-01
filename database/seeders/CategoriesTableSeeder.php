<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
        $categories = ['unclassified', 'Electronics', 'Mobile Phone', 'Cars', 'Motorcycles', 'Furnitures', 'Books', 'Belongings', 'Foods', 'Real estate', 'Services', 'Houseware', 'Animals', 'Clothes'];
        foreach ($categories as $key => $category) {
            $user = DB::table('users')->find(1);

            Category::create([
                'name' => $category,
                'description' => $faker->text($maxNbChars = 46),
                'image' => $faker->imageUrl,
                'user_id' => $user->id,
            ]);
        }
    }
}
