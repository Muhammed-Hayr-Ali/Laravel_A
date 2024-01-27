<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Message;

class MessageTableSeeder extends Seeder
{
    /**
     * name', 'email', 'message', 'status', 'user_id
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {
            $user = DB::table('users')->find(1);

            Message::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'message' => $faker->text($maxNbChars = 200),
                'status' => 'Unread',
                'user_id' => $user->id,
            ]);
        }
    }
}
