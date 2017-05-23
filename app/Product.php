<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Store;

class Product extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => false
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

	public function inCart()
	{
		return Cart::items($this->store)->where('id', $this->id)->first()->pivot->amount ?? 0;
	}

	public function subtractRemaining(int $amount)
	{
		$this->addRemaining(-$amount);
	}

	public function addRemaining(int $amount)
	{
		$remaining = $this->remaining + $amount;
		$this->update([
			'remaining' => $remaining
		]);
	}

	public function hasEnough(int $amount)
	{
		if ($this->remaining < $amount) {
			return false;
		} else {
			return true;
		}
	}

	public function requestedOrMax(int $amount)
	{
		$this->hasEnough($amount) ? $amount : $this->remaining;
	}

	public static function url()
	{
		return \Route::input('product');
	}

}
