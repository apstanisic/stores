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
        	for ($i=0; $i < 5; $i++) {
	        	$buyer = $store->buyers()->save(factory(App\Buyer::class)->make());
                if($buyer->id == 1) {
                    $buyer->update(['email' => 'aleksandar@example.com',
                                    'password' => '$2y$10$l07kG3A9ciFaauExHcFL2eAA7B8zSIP/3QAAG3vFgnMF3AyksOcHq'
                                    ]);
                }
	            $buyer->cart()->create(['store_id' => $store->id]);
        	}
        }
    }
}
