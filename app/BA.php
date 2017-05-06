<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;

class BA extends Model
{

    public function user(Store $store)
    {
    	return session('buyer_' . $store->$user->id . '/' . $store->id);
    }


    public static function check(Store $store)
    {
    	return session()->has('buyer_' . $store->$user->id . '/' . $store->id);
    }

    public static function guest(Store $store)
    {
    	return !$this::check($store);
    }

    public static function logout(Store $store)
    {
    	session()->forget('buyer_' . $store->$user->id . '/' . $store->id);
    }


    public static function attempt($username, $password, Store $store)
    {
    	$buyer = Buyer::where('username', $username)->where('password', bcrypt($password))->where('store_id', $store->id)->first();

    	if(!$buyer) {
    		return false;
    	} else {
    		session()->put('buyer_' . $store->$user->id . '/' . $store->id, $buyer);
    	}
    }
}
