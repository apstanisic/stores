<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\Product;
use App\BAuth;

class Cart extends Model
{
    // For database
    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps();
    }

    // To get content of cart
    public static function items()
    {
        if(BAuth::guest()) {
            return static::fromSession();
        }
        // dd(BAuth::buyer()->cart->products()->get());
        return BAuth::buyer()->cart->products()->get();
    }


    public function buyer()
    {
    	return $this->hasOne(Buyer::class);
    }

    public static function add(array $data)
    {
        //dd($data);
    	if (BAuth::guest()) {
			static::addToSession($data);
    	} else {
    		static::addToDb($data);
    	}
    }

    public static function emptyCart()
    {
    	if (BAuth::guest()) {
			static::emptyFromSession();
    	} else {
    		static::emptyFromDB();
    	}
    }

    public function removeItem(Product $product)
    {
    	if (BAuth::guest()) {
    		static::removeFromSession($product);
    	} else {
    		static::removeFromDb($product);
    	}
    }

    public static function removeFromDb(Product $product)
    {
    	BAuth::buyer()->cart->products->destroy($product->id);
    }

    private static function removeFromSession(Product $product)
    {
    	$session_name = 'cart_' . Store::url()->user->id . '/' . Store::url()->id;
        $tmpSessions = session($session_name);
        unset($tmpSessions[$product->name]);
        session()->put($session_name, $tmpSessions);
    }


	public static function fromSession()
    {
        $sessionProducts = session('cart_' . Store::url()->user->id . '/' . Store::url()->id) ?? [];
        $products = [];

        foreach ($sessionProducts as $name => $amount) {
            $product = Product::where('name', $name)->first();
            // Ima bolji nacin, trenutno ne mogu da trazim
            $product->pivot = (object)['amount' => $amount];
            $products[] = $product;
        }

        return $products;
    }



    private function emptyFromDB()
    {
    	BAuth::buyer()->cart->products->delete();
    }

	public static function emptyFromSession()
    {
        session()->forget('cart_' . Store::url()->user->id . '/' . Store::url()->id);
    }




    private static function addToSession(array $data)
    {
    	$session_name = 'cart_' . Store::url()->user->id . '/' . Store::url()->id;
        // Get all sessions with the name in to array
        $sessionProducts = session($session_name);
        // Add to array new item, or replace existing, where
        // key is product name and value is amount
        if(current($data) === '+1'){
            $sessionProducts[key($data)] = isset($sessionProducts[key($data)]) ? ++$sessionProducts[key($data)] : 1;
        } else {
            $sessionProducts[key($data)] = intval(current($data));
        }
        // Put array back into sessions
        session()->put($session_name, $sessionProducts);
    }

    private static function addToDb(array $data)
    {
        $productName = key($data);
        $amount = current($data);

    	$product = Product::where('name', $productName)->first();


        if($amount === '+1') {
            $currentAmount = BAuth::buyer()->cart->products->where('id', $product->id)->first() ?? 0;
            // dd($currentAmount);
            // $currentAmount = BAuth::buyer()->cart->products;
            // $currentAmount = \App\Buyer::find(1);
            // dd($currentAmount, BAuth::buyer());
            // $amount = BAuth::buyer()->cart->products()->where('name', $productName)->get();
            $amount = ++$currentAmount;
            // dd($amount);
        }
        // dd($product);
        BAuth::buyer()->cart->products()->detach($product->id);
		BAuth::buyer()->cart->products()->attach($product->id, ['amount' => $amount]);
    }



}
