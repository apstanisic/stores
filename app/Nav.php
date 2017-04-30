<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{

	protected $table = 'navigation';

	public function scopeLinks($query)
	{
		$query->where('type', 1);
	}

	public function scopeShopping($query)
	{
		$query->where('type', 2);
	}

}
