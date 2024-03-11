<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ProductOrderTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        // $this->call(CartTableSeeder::class);
        // $this->call(CartItemsTableSeeder::class);
        $this->call(MessageTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
