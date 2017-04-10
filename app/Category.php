<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = [
		'name', 'parent_id'
	];
	
    public $timestamps = false;

	


    public function products() {
    	return $this->hasMany('App\Product');
    }

    public function parent() {
    	return $this->belongsTo('App\Category');
    }
}
