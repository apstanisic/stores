<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\BuyerRegisterRequest;
use App\Buyer;
use App\Store;
use App\User;
use App\Cart;
use Hash;

class _BAuth extends Model
{
    // When logging in it will check this
    // field with provided password
    // Recommended username, email or slug
    // But you can set anything you want
    private static $field = 'email';

    // Ima problem kada se ceo kupac stavi u sesiju.
    // Ovako se cuva samo id, a kada se trazi kupac
    // Pravi se objekat od tog id-a // TODO:: maybe change method name to user
    public static function buyer(Store $store)
    {
    	$buyer_id = static::id($store);
        return Buyer::find($buyer_id);
    }

    public static function id(Store $store)
    {
        return session('buyer_' . $store->id);
    }

    // Check if buyer is logged in
    public static function check(Store $store)
    {
        return session()->has('buyer_' . $store->id);
    }


    // Check if buyer is not logged in
    public static function guest(Store $store)
    {
    	return !static::check($store);
    }

    // Logs out buyer
    public static function logout(Store $store)
    {
    	session()->forget('buyer_' . $store->id);
    }

    // $data = array with email and password
    public static function attempt(array $data, Store $store)
    {
        // You can see what field to check
    	$buyer = Buyer::where('store_id', $store->id)
                      ->where(static::$field, $data[static::$field])
                      ->first();

    	if (!$buyer) return false;

        if (!Hash::check($data['password'], $buyer->password)) return false;

        static::login($buyer);

        return true;

    }

    public static function register(array $data, Store $store)
    {
        $data['password'] = bcrypt($data['password']);
        $buyer = $store->buyers()->create($data);
        $cart = new Cart;
        $cart->store_id = $store->id;
        $buyer->cart()->save($cart);
        return $buyer;
    }

    // Store only id, there is a problem
    // when storing buyer object
    public static function login(Buyer $buyer)
    {
        session()->put('buyer_' . $buyer->store_id, $buyer->id);
        static::cartFromSessionToDb($buyer);
    }


    public static function cart()
    {
        if (static::guest()) {
            return null;
        } else {
            return static::buyer()->cart;
        }
    }

    // This will get cart from session if user
    // isn't logged in. cart() will get only
    // logged in user cart
    public function cartWithGuest(Store $store)
    {
        if (static::guest()) {
            return Cart::fromSession($store);
        } else {
            return static::cart();
        }
    }

    // Metoda se nalazi ovde jer je vezana za buyera a ne samo za cart
    // Jedino se izvrsava kada se korisnik loguje
    private static function cartFromSessionToDb(Buyer $buyer)
    {
        $products = Cart::fromSession($buyer->store);
        foreach ($products as $product) {
            $currentProduct = $buyer->cart->products->where('id', $product->id)->first();
            if ($currentProduct) {
                $product->pivot->amount = max($product->pivot->amount, $currentProduct->pivot->amount);
            }
            $buyer->cart->products()->detach($product);
            $buyer->cart->products()->attach($product, ['amount' => intval($product->pivot->amount)]);
        }
        Cart::removeAllFromSession($buyer->store);
    }
}
