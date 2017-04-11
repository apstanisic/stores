<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	
	protected $fillable = [
		'name',
		'description',
		'price',
		'remaining',
		'store_id',
		'category_id'
	];


	public function store () 
	{
		return $this->belongsTo(Store::class);
	}


	public function images () 
	{
		return $this->hasMany(Image::class);
	}
}
