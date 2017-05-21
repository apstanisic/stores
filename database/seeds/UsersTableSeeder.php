<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 2)->create()->each(function ($user) {
            if ($user->id == 1) {
                $user->username = 'aleksandar';
                $user->email = 'aleksandar@example.com';
                $user->password = '$2y$10$l07kG3A9ciFaauExHcFL2eAA7B8zSIP/3QAAG3vFgnMF3AyksOcHq';
                $user->save();
            }
        });
    }
}
