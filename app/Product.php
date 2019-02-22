<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
				'source' => 'name',
				'onUpdate' => true
            ]
        ];
    }


	protected $fillable = [
		'name',
		'description',
		'price',
		'remaining',
		'category_id'
	];

    public function getRouteKeyName()
    {
        return 'slug';
    }


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

	// public function inCart()
	// {
	// 	return Cart::items($this->store)->where('id', $this->id)->first()->pivot->amount ?? 0;
	// }


	/**
	 * Change remaing amount in stock
	 *
	 * @param integer $amount
	 * @param boolean $replace Should new value replace old or calculate old and new
	 * @return void
	 */
	public function changeRemaining(int $amount, bool $replace = false)
	{
		$amount = $replace ? $amount : $this->remaining + $amount;

		$this->update(['remaining' => $amount]);
	}
	

	/**
	 * Return maximum number that can be put in the cart depending of available products
	 * If remaining product amount is not specified it will return requested amount
	 *
	 * @param integer $amount
	 * @return int
	 */
	public function requestedOrMax(int $amount)
	{
		if ($this->remaining === null) {
			return $amount;
		}

		return $this->remaining > $amount ? $amount : $this->remaining;
	}

	
}
