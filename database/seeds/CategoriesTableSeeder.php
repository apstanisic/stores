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
                if ($store->categories->isEmpty() || random_int(0, 1)) {
                    $parentId = null;
                } else {
                    $parentId = $store->categories()->pluck('id')->random();
                }
                $store->categories()->save(factory(App\Category::class)->make(['parent_id' => $parentId]));
            }
        }
    }
}
