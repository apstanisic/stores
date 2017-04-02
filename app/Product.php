<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	
	protected $fillable = [
		'name', 'description', 'price', 'remaining', 'store_id', 'category_id'
	];


	public function store () {
		return $this->belongsTo('App\Store');
	}


	public function images () {
		return $this->hasMany('App\Image');
	}
}
