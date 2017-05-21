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
        Status::create([
            'name' => 'confirmed',
            'description' => 'Porudzbina je primljena na procesuiranje',
        ]);

        Status::create([
            'name' => 'sent',
            'description' => 'Porudzbina je poslata',
        ]);

        Status::create([
            'name' => 'not_sent',
            'description' => 'Porudzbina ne moze da bude poslata',
        ]);

        Status::create([
            'name' => 'delivered',
            'description' => 'Primalac je primio porudzbinu',
        ]);

        Status::create([
            'name' => 'declined',
            'description' => 'Porudzbina je primljena',
        ]);

        Status::create([
            'name' => 'deleted',
            'description' => 'Porudzbina je primljena',
        ]);

        Status::create([
            'name' => 'paused',
            'description' => 'Porudzbina je primljena',
        ]);

        Status::create([
            'name' => 'canceled',
            'description' => 'Porudzbina je otkazana',
        ]);
    }
}