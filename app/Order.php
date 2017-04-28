<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function products()
    {
    	$this->belongsToMany(Product::class)->withTimestamps();
    }

    public function buyer()
    {
    	$this->belongsTo(Buyer::class);
    }

    public function store()
    {
    	$this->belognsTo(Store::class);
    }

    public function status()
    {
    	$this->belognsTo(Status::class);
    }
}
