<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
    		'username' => str_randon(10),
    		'username' => str_randon(10) . '@gmail.com',
    		'password' => bcrypt('secret')

    	]);
    }
}
