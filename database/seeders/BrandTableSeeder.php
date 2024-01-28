<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Faker\Factory as Faker;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Brand::create([
            'name' => 'unknown',
            'description' => $faker->text($maxNbChars = 10),
            'image' => $faker->imageUrl,
        ]);

        for ($i = 0; $i < 12; $i++) {
            Brand::create([
                'name' => $faker->word,
                'description' => $faker->text($maxNbChars = 10),
                'image' => $faker->imageUrl,
            ]);
        }
    }
}
