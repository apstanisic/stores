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
        $categories = \App\Category::all();
        $buyers = \App\Buyer::all();
        $status = \App\Status::pluck('id');
        $orders = [];

    	// Creates orders
        foreach ($buyers as $buyer) {
        	for ($i=0; $i < 5; $i++) {
        		$orders[] = $buyer->orders()->create([
                    'store_id' => $buyer->store_id,
                    'status_id' => $status->random(),
                    'price' => 0,
                    'address_id' => $buyer->addresses->random()->id
			  	]);
        	}
        }

        // $orders = \App\Order::all();



        foreach ($orders as $order) {

        	$products = $order->store->products;
        	// $productIds = $products->pluck('id')->toArray();
        	$random = rand(1, 10);

        	for ($i=0; $i < $random; $i++)
    		{
                // $product = $products->find($faker->randomElement($productIds));
                // $product= $faker->randomElement($products);
                $product = $products->random();

        		DB::table('order_product')->insert([
        			'order_id' => $order->id,
					'product_id' => $product->id, //$faker->randomElement($productIds),
					'amount' => $faker->numberBetween(1, 10),
                    'product_price' => $product->price,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
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
