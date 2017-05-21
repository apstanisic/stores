<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        foreach ($users as $user) {
        	for ($i=0; $i < 3; $i++) {
        		$user->stores()->save(factory(App\Store::class)->make());
        	}
        }
    }
}
