<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users()
    {
    	$this->belongsToMany(User::class)->withTimestamps();
    }

    public function premissions()
    {
    	return $this->belongsToMany(Premission::class)->withTimestamps();
    }
}
