<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
use App\Store;
use App\User;
use Hash;

class BAuth extends Model
{

    public static function buyer()
    {
    	return session('buyer_' . Store::url()->user->id . '/' . Store::url()->id);
    }


    public static function check()
    {
    	return session()->has('buyer_' . Store::url()->user->id . '/' . Store::url()->id);
    }

    public static function guest()
    {
    	return !static::check();
    }

    public static function logout()
    {
    	session()->forget('buyer_' . Store::url()->user->id . '/' . Store::url()->id);
    }


    public static function attempt(array $data)
    {
    	$buyer = Buyer::where('email', $data['email'])->where('store_id', Store::url()->id)->first();

    	if (!$buyer) return false;

        if (!Hash::check($data['password'], $buyer->password)) return false;


		session()->put('buyer_' . Store::url()->user->id . '/' . Store::url()->id, $buyer);
        static::cartFromSessionToDb($buyer);

        return true;

    }

    // Returns cart, if buyer not logged in, return cart from session
    // if buyer logged in, return cart from database
    public static function cart()
    {
        if (BAuth::guest()) {
            // return Cart::fromSession($store);
            return null;
        }
        return static::buyer(Store::url())->cart;
    }



    private static function cartFromSessionToDb(Buyer $buyer)
    {
        $products = Cart::fromSession();
        foreach ($products as $product) {
            //$product = Product::where('name', $name)->first();
            $buyer->cart->products()->attach($product, ['amount' => $product->pivot->amount]);
        }
        Cart::emptyFromSession();
    }
}
