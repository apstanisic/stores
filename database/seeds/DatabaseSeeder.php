<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusTableSeeder::class,
            UsersTableSeeder::class,
            StoresTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            BuyersTableSeeder::class,
            AddressesTableSeeder::class,
            OrdersTableSeeder::class,
        ]);
    }
}
