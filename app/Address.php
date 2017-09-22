<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Address extends Model
{
	use Sluggable;

	protected $fillable = ['name', 'slug', 'street_name', 'building_number', 'city', 'postal_code'];

	public function sluggable()
	    {
	        return [
	            'slug' => [
	                'source' => 'name',
	                'unique' => false
	            ]
	        ];
	    }

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function buyer()
	{
		return $this->belongsTo(Buyer::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
