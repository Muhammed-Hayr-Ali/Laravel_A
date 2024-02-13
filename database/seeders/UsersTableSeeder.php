<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *    'name',
     *    'email',
     *    'status',
     *    'country_code',
     *    'phone_number',
     *    'gender',
     *    'date_birth',
     *    'profile',
     *    'password',
     *    'permissions',
     *    'expiration_date',
     *    'email_verified_at',
     *    'default_address',
     */
    public function run(): void
    {
        $faker = Faker::create();
        $password = Hash::make('Aa99009900');
        $role = DB::table('roles')->find(1);
        User::create([
            'name' => 'Mohammed kher Ali',
            'phoneNumber' => '0992058011',
            'email' => 'm.thelord963-test@gmail.com',
            'password' => $password,
            'role_id' => $role->id,
            'gender' => 'Male',
            // 'dateBirth' => '1986-11-8',
            'status' => 'لا يؤخر الله أمراً إلا لخير، ولا يحرمك أمراً إلا لخير، ولا ينزل عليك بلاء إلا لخير',
            'profile' => 'uploads/profile/profile-picture.jpg',
            'email_verified_at' => Carbon::now(),
        ]);
        // for ($i = 0; $i < 18; $i++) {
        //     $role = DB::table('roles')->find(3);

        //     User::create([
        //         'name' => $faker->firstName(),
        //         'phoneNumber' => $faker->phoneNumber(),
        //         'email' => $faker->email,
        //         'password' => $password,
        //         'role_id' => $role->id,
        //         'gender' => $faker->randomElement(['Unspecified', 'Male', 'Female']),
        //         'status' => $statusList[$i],
        //         // 'dateBirth' => $faker->date($format = 'm/d/Y', $max = 'now'),
        //         // 'profile' => $faker->imageUrl,
        //     ]);
        // }
    }
}
