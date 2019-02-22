<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'email', 'password'
    ];

	protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function cart_items()
    {
    	return $this->hasMany(CartItem::class, 'product_id')->withPivot('amount')->withTimestamps();;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // public function hasOrder(Order $order)
    // {
    //     // if (BAuth::buyer()->orders()->where('id', $order->id)->count()) {
    //     if ($this->orders()->where('id', $order->id)->count()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}
