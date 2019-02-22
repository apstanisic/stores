<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use Sluggable;

	protected $fillable = ['name', 'description'];

	public function getRouteKeyName()
	{
		return 'slug';
	}

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
				'onUpdate' => true
            ]
        ];
    }


	public function user() 
	{
		return $this->belongsTo(User::class);
	}


	public function categories() 
	{
		return $this->hasMany(Category::class);
	}


	public function products() 
	{
		return $this->hasMany(Product::class);
	}


	public function buyers()
	{
		return $this->hasMany(Buyer::class);
	}


	public function orders()
	{
		return $this->hasMany(Order::class);
	}


	/* Allows for $store->profit */
	public function getProfitAttribute()
	{
		$profit = 0;
		
		foreach ($this->orders()->get() as $order) {
			$profit += $order->price;
		}

		return $profit;
	}


	// $store->soldProducts()
	public function soldProducts()
	{
		$count = 0;
		foreach ($this->orders as $order) {
			$count += $order->products()->count();
		}
		return $count;
	}



	/**
	 * Finds store by slug, if no ownerSlug is provided,
	 * it will asume it is current auth user slug
	 *
	 * @param string $storeSlug
	 * @return object Builder
	 */
	public static function findBySlug($storeSlug) 
	{
		return Store::where('slug', $storeSlug);
		// if ($ownerSlug === null) {
		// 	$ownerSlug = auth()->user()->slug;
		// }
		// return static::where('slug', $storeSlug)->whereHas('user', function ($query) use ($ownerSlug) {
		// 	$query->where('slug', $ownerSlug);
		// });

	}

	/**
	 * Get store from url
	 *
	 * @return App\Store
	 */
	public static function fromUrl()
	{
		// $user = \Route::input('user') ?? null;
		$store = \Route::input('store');
		return $store;
		// return static::findBySlug($store)->first();
	}

	
}
