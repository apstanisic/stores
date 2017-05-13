<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;

class Product extends Model
{

	protected $fillable = [
		'name',
		'description',
		'price',
		'remaining',
		'category_id'
	];


	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function store()
	{
		return $this->belongsTo(Store::class);
	}


	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function inCart()
	{
		return Cart::items()->where('id', $this->id)->first()->pivot->amount ?? 0;
	}

}
