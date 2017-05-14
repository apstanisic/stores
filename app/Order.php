<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps();
    }

    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    public function store()
    {
    	return $this->belongsTo(Store::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function canEdit()
    {
        if ($this->status->name !== 'u_pripremi' && $this->status->name !== 'pauzirano') {
            return false;
        }
        return true;
    }
}
