<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\BAuth;

class Buyer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username', 'email', 'password'
    ];

	protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function cart()
    {
    	return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function hasOrder($order)
    {
        if (BAuth::buyer()->orders()->where('id', $order->id)->count()) {
            return true;
        } else {
            return false;
        }
    }
}
