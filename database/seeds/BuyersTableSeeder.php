<?php

use Illuminate\Database\Seeder;

class BuyersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\Store::all();

        foreach ($stores as $store) {
            $buyers = factory(App\Buyer::class, 4)->create([
                'store_id' => $store->id,
            ]);

            App\Buyer::where('store_id', $store->id)->first()->update([
                'username' => 'testing',
                'email' => 'testing@example.com'
            ]);
        }

    }
}
