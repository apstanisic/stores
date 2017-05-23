<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyers = \App\Buyer::all();

        foreach ($buyers as $buyer) {
        	$times = rand(1, 4);
        	for ($i=0; $i < $times; $i++) {
        		// dd($buyer->addresses);
        		$buyer->addresses()->save(factory(App\Address::class)->make());
        	}
        }
    }
}
