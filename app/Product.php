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
		'store_id', // Mozda ovo ne treba da bude fillable, jer ide store->product->create()
		'category_id'
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
