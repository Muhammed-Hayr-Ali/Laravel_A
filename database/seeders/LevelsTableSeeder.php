<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
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
        $levels = ['premium', 'discounts', 'popular', 'normal'];
        foreach ($levels as $key => $level) {
            $user = DB::table('users')->find(1);

            Level::create([
                'name' => $level,
                'description' => $faker->text($maxNbChars = 46),
                'image' => $faker->imageUrl,
                'user_id' => $user->id,
            ]);
        }
    }
}
