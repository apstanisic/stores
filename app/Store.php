<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;
use App\Category;
use App\Product;
use App\Order;

class Store extends Model
{
	use Sluggable;

	protected $fillable = [
		'name', 'description'
	];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => false
            ]
        ];
    }

    // Route model binding sa slugom, a ne sa id
    public function getRouteKeyName()
    {
        return 'slug';
    }

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function categories() {
		return $this->hasMany(Category::class);
	}

	public function products() {
		return $this->hasMany(Product::class);
	}

	public function buyers()
	{
		return $this->hasMany(Buyer::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class)->withTrashed();
	}

	// All store where owner is currently logged user
	public function scopeIsOwner($query) {
		$query->where('user_id', Auth::id());
	}

	public function hasCategory(Category $category) {

		$category = $this->categories()->find($category->id);

		if (!$category) {
			return false;
		}

		return true;
	}

	public function hasProduct(Product $product)
	{
		$product = $this->products()->find($product->id);

		if (!$product) {
			return false;
		}

		return true;
	}

	public function hasOrder(Order $order)
	{
		$order = $this->orders()->find($order->id);

		if (!$order) {
			return false;
		}

		return true;
	}

	// Dohvata prodavnicu preko url-a
	public static function url() {
		return \Route::input('store');
	}
}
