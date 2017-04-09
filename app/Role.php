<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users()
    {
    	$this->belongsToMany('App\User')->withTimestamps();
    }

    public function premissions()
    {
    	return $this->belongsToMany('App\Premission')->withTimestamps();
    }
}
