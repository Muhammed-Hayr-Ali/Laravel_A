<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $user = DB::table('users')->find(1);

        Brand::create([
            'name' => 'unknown',
            'description' => $faker->text($maxNbChars = 10),
            'image' => $faker->imageUrl,
            'user_id' => $user->id,
        ]);

        for ($i = 0; $i < 12; $i++) {
            $user = DB::table('users')->find(1);

            Brand::create([
                'name' => $faker->word,
                'description' => $faker->text($maxNbChars = 10),
                'image' => $faker->imageUrl,
                'user_id' => $user->id,
            ]);
        }
    }
}
