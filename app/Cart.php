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
        // return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps()->get();
        return BAuth::buyer()->cart->products;
    }


    public function buyer()
    {
    	return $this->hasOne(Buyer::class);
    }

    public static function add(array $data)
    {
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
            // $product->pivot->amount = $amount;
            $product->pivot = (object)['amount' => $amount];
            // $product->pivot->amount = $amount;
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
    	$product = Product::where('name', key($data))->first();

        // dd($product);
        BAuth::buyer()->cart->products()->detach($product);
		BAuth::buyer()->cart->products()->attach($product, ['amount' => current($data)]);
    }



}
