<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Category::all();

        foreach ($categories as $category) {
        	for ($i=0; $i < 10; $i++) {
        		$product = $category->products()->save(factory(App\Product::class)->make(['store_id' => $category->store_id]));
        	}
        }
    }
}
