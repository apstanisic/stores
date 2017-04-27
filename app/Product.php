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
		'category_id'
		// 'store_id', // Ovo ne treba da bude fillable, jer ide store->product->create()
	];


	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function store ()
	{
		return $this->belongsTo(Store::class);
	}


	public function images ()
	{
		return $this->hasMany(Image::class);
	}

}
