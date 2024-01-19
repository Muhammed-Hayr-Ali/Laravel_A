<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  'order_number'
     *  'user_id',
     *  'address_id',
     *  'status',
     *  'total_amount',
     *  'notes',
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            $user = DB::table('users')
                ->inRandomOrder()
                ->first();
            $addresses = DB::table('addresses')
                ->inRandomOrder()
                ->first();
            $orderNumber = uniqid();
            Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'address_id' => $addresses->id,
                'status' => 'Pending',
                'notes' => 'no note',
            ]);
        }
    }
}
