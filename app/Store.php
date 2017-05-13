<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Store extends Model
{

	protected $fillable = [
		'name', 'description'
	];

/* Route model binding sa name a ne sa id
	public function getRouteKeyName()
	{
		return 'name';
	}
*/
	// Prodavnica pripada user-u
	public function user() {
		// return $this->belongsTo('App\User');
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


	// Sve prodavnice ciji je vlasnik ulogovani korisnik
	public function scopeIsOwner($query) {
		$query->where('user_id', Auth::id());
	}

	public function hasCategory($category) {

		$category = $this->categories()->find($category);

		if (!$category) {
			return false;
		}

		return true;
	}

	public function hasProduct($product)
	{
		$product = $this->products()->find($product);

		if (!$product) {
			return false;
		}

		return true;
	}

	// Dohvata prodavnicu preko url-a
	public static function url() {
		return \Route::input('store');
	}
}
