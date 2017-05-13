<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\Product;
use App\BAuth;

class Cart extends Model
{
    // Dohvata sve proizvode iz baze
    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps();
    }

    // Kupac
    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    public static function price()
    {
        $price = 0;

        foreach (static::items() as $product) {
            $price += $product->price * $product->pivot->amount;
        }

        return $price;
    }

    public static function isEmpty()
    {
        $productsCount = count(static::items());

        if($productsCount < 0) {
            return false;
        }
        return true;
    }
    // To get content of cart
    // Ako je guest vraca iz sesije, ako nije vraca
    // iz baze preko products metode
    public static function items()
    {
        if(BAuth::guest()) {
            return static::fromSession();
        }
        // dd(BAuth::buyer()->cart->products()->get());
        return BAuth::buyer()->cart->products()->get();
    }

    public static function amount(Product $product)
    {
        if (BAuth::guest()) {
            return('cart_' . Store::url()->user->id . '/' . Store::url()->id)[$product->name] ?? 0;
        } else {
            return BAuth::buyer()->cart->products->find($product->id)->pivot->amount ?? 0;
        }
    }


    // Dodaje u korpu
    // public static function add(array $data) // Stari nacin
    public static function add(Product $product, $amount)
    {
        $amount = intval($amount);

    	if (BAuth::guest()) {
            static::addToSession($product->name, $amount);
    	} else {
            static::addToDb($product->name, $amount);
    	}
    }

    // Izpraznjuje korpu
    public static function emptyCart()
    {
    	if (BAuth::guest()) {
			static::emptyFromSession();
    	} else {
    		static::emptyFromDB();
    	}
    }

    // Brise proizvod iz korpe
    public static function removeItem(Product $product)
    {
    	if (BAuth::guest()) {
    		static::removeFromSession($product);
    	} else {
    		static::removeFromDb($product);
    	}
    }

    // Izbacuje proizvod iz baze
    public static function removeFromDb(Product $product)
    {
    	BAuth::buyer()->cart->products()->detach($product->id);
    }

    // Izbacuje proizvod iz sesije
    private static function removeFromSession(Product $product)
    {
    	$session_name = 'cart_' . Store::url()->user->id . '/' . Store::url()->id;
        $tmpSessions = session($session_name);
        unset($tmpSessions[$product->name]);
        session()->put($session_name, $tmpSessions);
    }

    // Vraca sve proizvode iz sesije
    // Ne postoji ekvivalenta metoda za bazu
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


    // Izpraznjuje celu korpu iz baze
    private static function emptyFromDB()
    {
    	BAuth::buyer()->cart->products()->detach();
    }

    // Izpraznjuje celu korpu iz sesije
	public static function emptyFromSession()
    {
        session()->forget('cart_' . Store::url()->user->id . '/' . Store::url()->id);
    }



    // Add new product to session cart
    private static function addToSession($productName, $amount)
    {
    	$session_name = 'cart_' . Store::url()->user->id . '/' . Store::url()->id;
        $sessionProducts = session($session_name);

        if($amount === '+1'){
            $sessionProducts[$productName] = isset($sessionProducts[$productName]) ? ++$sessionProducts[$productName] : 1;
        } else {
            $sessionProducts[$productName] = intval($amount);
        }

        session()->put($session_name, $sessionProducts);
    }

    // Add new product to database cart
    private static function addToDb($productName, $amount)
    {
        $product = Product::where('name', $productName)->first();

        if($amount === '+1') {
            $currentAmount = BAuth::buyer()->cart->products->where('id', $product->id)->first()->pivot->amount ?? 0;
            $amount = ++$currentAmount;
        }

        BAuth::buyer()->cart->products()->detach($product->id);
		BAuth::buyer()->cart->products()->attach($product->id, ['amount' => $amount]);
    }



}
