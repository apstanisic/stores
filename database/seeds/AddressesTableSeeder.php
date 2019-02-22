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
        	$amount = rand(1, 4);
            factory(App\Address::class, $amount)->create([
                'buyer_id' => $buyer->id
            ]);
                // for ($i=0; $i < $times; $i++) {
                // 	// dd($buyer->addresses);
                // 	$buyer->addresses()->save(factory(App\Address::class)->make());
                // }
        }
    }
}
