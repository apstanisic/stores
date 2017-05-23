<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\Product;
// use App\BAuth;

class Cart extends Model
{
    protected $fillable = ['store_id'];

    // Dohvata sve proizvode iz baze
    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps();
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getPriceAttribute()
    {
        return static::price($this->store);
    }

    public static function price(Store $store)
    {
        $price = 0;

        foreach (static::items($store) as $product) {
            $price += $product->price * $product->pivot->amount;
        }

        return $price;
    }

    public static function isEmpty(Store $store)
    {
        $productsCount = count(static::items($store));

        if($productsCount > 0) {
            return false;
        } else {
            return true;
        }
    }
    // To get content of cart
    // Ako je guest vraca iz sesije, ako nije vraca
    // iz baze preko products metode
    public static function items(Store $store)
    {
        // if(BAuth::guest($store)) {
        if (bauth($store)->guest()) {
            return static::fromSession($store);
        } else {
            // return BAuth::buyer($store)->cart->products()->get();
            return bauth($store)->cart()->products;
        }
    }

    public static function amount(Product $product)
    {
        if (bauth($product->store)->guest()) {
            return('cart_' . $product->store_id)[$product->slug] ?? 0;
        } else {
            return bauth($product->store)->cart()->products->find($product->id)->pivot->amount ?? 0;
        }
    }


    // Dodaje u korpu
    // public static function add(array $data) // Stari nacin
    public static function add(Product $product, $amount)
    {
    	if (bauth($product->store)->guest()) {
            static::addToSession($product, $amount);
    	} else {
            static::addToDb($product, $amount);
    	}
    }

    // Izpraznjuje korpu
    public static function removeAll(Store $store)
    {
    	if (bauth($store)->guest()) {
			static::removeAllFromSession($store);
    	} else {
    		static::removeAllFromDb($store);
    	}
    }

    // Brise proizvod iz korpe
    public static function removeItem(Product $product)
    {
    	if (bauth($product->store)->guest()) {
    		static::removeFromSession($product);
    	} else {
    		static::removeFromDb($product);
    	}
    }

    // Izbacuje proizvod iz baze
    public static function removeFromDb(Product $product)
    {
    	bauth($product->store)->cart()->products()->detach($product->id);
    }

    // Izbacuje proizvod iz sesije
    private static function removeFromSession(Product $product)
    {
    	$session_name = 'cart_' . $product->store_id;
        $sessions = session($session_name);
        unset($sessions[$product->slug]);
        session()->put($session_name, $sessions);
    }

    // Vraca sve proizvode iz sesije
    // Ne postoji ekvivalenta metoda za bazu
	public static function fromSession(Store $store)
    {
        $sessionProducts = session('cart_' . $store->id) ?? [];
        $products = [];

        foreach ($sessionProducts as $slug => $amount) {
            $product = Product::where('store_id', $store->id)
                              ->where('slug', $slug)->first();
            // TODO:: there has to be better way
            $product->pivot = (object)['amount' => $amount];
            $products[] = $product;
        }

        return collect($products);
    }


    // Izpraznjuje celu korpu iz baze
    private static function removeAllFromDb(Store $store)
    {
    	bauth($store)->cart()->products()->detach();
    }

    // Izpraznjuje celu korpu iz sesije
	public static function removeAllFromSession(Store $store)
    {
        session()->forget('cart_' . $store->id);
    }



    // Add new product to session cart
    private static function addToSession(Product $product, $amount)
    {
    	$session_name = 'cart_' . $product->store_id;
        // Key is product slug, value is product amount
        $products = session($session_name);

        if($amount === '+1'){
            $products[$product->slug] = isset($products[$product->slug]) ? ++$products[$product->slug] : 1;
        } else {
            $products[$product->slug] = intval($amount);
        }

        session()->put($session_name, $products);
    }

    // Add new product to database cart
    private static function addToDb(Product $product, $amount)
    {
        if($amount === '+1') {
            $currentAmount = bauth($product->store)->cart()->products->where('id', $product->id)->first()->pivot->amount ?? 0;
            $amount = ++$currentAmount;
        }

        bauth($product->store)->cart()->products()->detach($product->id);
		bauth($product->store)->cart()->products()->attach($product->id, ['amount' => intval($amount)]);
    }



}

// [
//     0 => [
//         'product' => $product,
//         'amount' => $product->pivot->amount
//     ]

// ]
