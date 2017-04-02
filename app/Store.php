<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
