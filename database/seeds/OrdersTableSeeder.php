<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = \Faker\Factory::create();
        // dd($faker->colorName);
        $categories = \App\Category::all();
        $buyers = \App\Buyer::all();
        $status = \App\Status::pluck('id')->toArray();
        // dd($status);
    	// Creates orders
        foreach ($buyers as $buyer) {
        	for ($i=0; $i < 5; $i++) {
        		$buyer->orders()->create(['store_id' => $buyer->store_id,
    									  'status_id' => $faker->randomElement($status),
    									  'price' => 0
			  	]);
        	}
        }

        $orders = \App\Order::all();



        foreach ($orders as $order) {

        	$products = $order->store->products();
        	$productIds = $products->pluck('id')->toArray();
        	$random = rand(1, 10);

        	for ($i=0; $i < $random; $i++)
    		{
        		DB::table('order_product')->insert([
        			'order_id' => $order->id,
					'product_id' => $faker->randomElement($productIds),
					'amount' => $faker->numberBetween(1, 10),
    			]);
        	}
        	// $price = 0;
        	$pivot = DB::table('order_product')->where('order_id', $order->id)->get();
        	foreach ($pivot as $row) {
        		$order->price += $row->amount * \App\Product::find($row->product_id)->price;
        	}
        	$order->save();
        }


    }
}
