<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
	        	if($store->categories()->get()->isNotEmpty()) {
			        $parentCategory = $store->categories()->pluck('id')->random();
			    } else {
			        $parentCategory = null;
			    }
			    $optional = rand(1, 10);
			    if ($optional > 5) $parentCategory = null;
			    $category = $store->categories()->save(factory(App\Category::class)->make(['parent_id' => $parentCategory]));
		    }
        }



    }
}
