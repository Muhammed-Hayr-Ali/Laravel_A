<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
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
        $roles = ['Admin', 'Editor', 'User', 'Banned', 'Guest'];
        foreach ($roles as $key => $role) {
            Role::create([
                'name' => $role,
                'description' => $faker->text($maxNbChars = 46),
                'image' => $faker->imageUrl,
            ]);
        }
    }
}
