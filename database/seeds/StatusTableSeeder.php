<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id = 1
        Status::create([
            'name' => 'processing',
            'description' => 'Porudzbina je primljena na procesuiranje.',
        ]);
        // id = 2
        Status::create([
            'name' => 'confirmed',
            'description' => 'Porudzbina je primljena na procesuiranje.',
        ]);
        // id = 3
        Status::create([
            'name' => 'problem',
            'description' => 'Problem sa porudzbinom.',
        ]);
        // id = 4
        Status::create([
            'name' => 'paused',
            'description' => 'Porudzbina je pauzirana.',
        ]);
        // id = 5
        Status::create([
            'name' => 'canceled',
            'description' => 'Porudzbina je otkazana.',
        ]);
        // id = 6
        Status::create([
            'name' => 'sent',
            'description' => 'Porudzbina je u tranzitu.',
        ]);
        // id = 7
        Status::create([
            'name' => 'delivered',
            'description' => 'Porudzbina je dostavljena.',
        ]);
        // id = 8
        Status::create([
            'name' => 'returned',
            'description' => 'Porudzbina je vracena.',
        ]);
        // id = 9
        Status::create([
            'name' => 'deleted',
            'description' => 'Porudzbina je obrisana.',
        ]);

    }
}
