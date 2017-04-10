<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Store extends Model
{

    protected $fillable = [
        'name'
    ];

    
	// Prodavnica pripada user-u
    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function categories () {
    	return $this->hasMany('App\Category');
    }

    public function products () {
    	return $this->hasMany('App\Product');
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
}
