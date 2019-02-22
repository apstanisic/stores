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
            factory(App\Store::class, 2)->create([
                'user_id' => $user->id,
            ]);
        }

    }
}
