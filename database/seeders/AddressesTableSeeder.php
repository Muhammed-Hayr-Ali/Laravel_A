<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *     'user_id',
     *     'recipient_name',
     *     'phone_number',
     *     'country',
     *     'state',
     *     'city',
     *     'address_line_1',
     *     'address_line_2',
     *     'latitude',
     *     'longitude',
     */
    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            $user = DB::table('users')->inRandomOrder()->first();

            Address::create([
                'user_id' => $user->id,
                'recipient_name' =>  $faker->name,
                'phone_number' =>  $faker->phoneNumber,
                'country' => $faker->country,
                'state' => $faker->state,
                'city' => $faker->city,
                'address_line_1' =>  $faker->address,
                'address_line_2'  => $faker->address,
                'latitude'  => $faker->latitude(-90, 90),
                'longitude'  => $faker->longitude(-90, 90),
            ]);
        }
    }
}
