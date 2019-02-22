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


        $categories = App\Category::all();
        $buyers = App\Buyer::all();
        $orders = [];

    	// Creates orders
        foreach ($buyers as $buyer) {
        	for ($i=0; $i < 3; $i++) {
        		$orders[] = $buyer->orders()->create([
                    'store_id' => $buyer->store_id,
                    'status_id' => App\Status::pluck('id')->random(),
                    'price' => 0,
                    'address_id' => $buyer->addresses->random()->id
			  	]);
        	}
        }



        /*
        For each order create products in it,
        and update order price 
         */
        foreach ($orders as $order) {

        	$products = $order->store->products;

        	for ($i=0; $i < rand(2, 5); $i++)
    		{
                $product = $products->shuffle()->shift();

        		DB::table('order_product')->insert([
        			'order_id' => $order->id,
					'product_id' => $product->id,
					'amount' => rand(1,10),
                    'product_price' => $product->price,
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
    			]);
        	}

            // DB::table('order_product')
            //     ->where('order_id', $order->id)->get()
            //     ->each(function($row, $key) {
            //         $order->price += $row->amount * App\Product::find($row->product_id)->price;
            // });

            $orderProductPivot = DB::table('order_product')
                                   ->where('order_id', $order->id)->get();

        	foreach ($orderProductPivot as $row) {
        		$order->price += $row->amount * App\Product::find($row->product_id)->price;
        	}

        	$order->save();
        }


    }
}
