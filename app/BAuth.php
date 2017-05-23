<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
use App\Store;
use App\Cart;
use Hash;

class BAuth extends Model
{
    // When logging in it will check this field with provided password
    // Recommended username, email or slug but you can set anything you want
    private static $field = 'email';
    private $store;

    public function __construct(Store $store = null)
    {
        // if ($store === null) $store = Store::url();
        $store = $store ?? Store::url();

        if(!$store) throw new Exception('Invalid parameters for buyer auth');

        $this->store = $store;
    }
    // Ima problem kada se ceo kupac stavi u sesiju.
    // Ovako se cuva samo id, a kada se trazi kupac
    // Pravi se objekat od tog id-a // TODO:: how call user or buyer
    public function user()
    {
    	$buyer_id = $this->id();
        return Buyer::find($buyer_id);
    }

    // gets current buyer id or null
    public function id()
    {
        return session('buyer_' . $this->store->id);
    }

    // Check if buyer is logged in
    public function check()
    {
        return session()->has('buyer_' . $this->store->id);
    }


    // Check if buyer is not logged in
    public function guest()
    {
    	return ! $this->check();
    }

    // Logs out buyer
    public static function logout()
    {
    	session()->forget('buyer_' . $this->store->id);
    }

    // $data = array with email and password
    public function attempt(array $data)
    {
        $buyer = $this->store->buyers->where(static::$field, $data[static::$field])->first();

    	if (!$buyer) return false;

        if (!Hash::check($data['password'], $buyer->password)) return false;

        $this->login($buyer);

        return true;

    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $buyer = $this->store->buyers()->create($data);
        $buyer->cart()->create(['store_id' => $this->store->id]);

        return $buyer;
    }

    // Store only id, there is a problem when storing buyer object
    public function login(Buyer $buyer)
    {
        session()->put('buyer_' . $this->store->id, $buyer->id);
        $this->cartFromSessionToDb($buyer);
    }

    // returns logged buyer cart
    public function cart()
    {
        if ($this->guest()) {
            return null;
        } else {
            return $this->user()->cart;
        }
    }

    // This will get cart from session if user isn't logged in.
    //cart() will get only logged in user cart
    public function cartWithGuest(Store $store)
    {
        if ($this->guest()) {
            return Cart::fromSession($store);
        } else {
            return $this->cart();
        }
    }

    // Metoda se nalazi ovde jer je vezana za buyera a ne samo za cart
    // Jedino se izvrsava kada se korisnik loguje
    private function cartFromSessionToDb(Buyer $buyer)
    {
        $products = Cart::fromSession($this->store);
        foreach ($products as $product) {
            $currentProduct = $buyer->cart->products->where('id', $product->id)->first();
            if ($currentProduct) {
                $product->pivot->amount = max($product->pivot->amount, $currentProduct->pivot->amount);
            }
            $buyer->cart->products()->detach($product);
            $buyer->cart->products()->attach($product, ['amount' => intval($product->pivot->amount)]);
        }
        Cart::removeAllFromSession($this->store);
    }
}
