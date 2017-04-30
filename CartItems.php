<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
	protected $table = 'cart';

	public function buyer()
	{
		$this->belongsTo(Buyer::class);
	}

	public function store()
	{
		$this->belognsTo(Store::class);
	}

	public function products()
	{
		$this->belognsToMany(Product::class)->withTimestamps();
	}
}
