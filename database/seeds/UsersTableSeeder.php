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
        // First user is always 'testing', easier for testing
        factory(App\User::class, 2)->create();
        // ->each(function ($user) {
        //     if ($user->id == 1) {
        //         $user->username = 'testing';
        //         $user->email = 'testing@example.com';
        //         $user->save();
        //     }
        // });
        App\User::first()->update([
            'username' => 'testing',
            'email' => 'testing@example.com'
        ]);
    }
}
