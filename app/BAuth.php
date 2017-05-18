<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\BuyerRegisterRequest;
use App\Buyer;
use App\Store;
use App\User;
use App\Cart;
use Hash;

class BAuth extends Model
{

    // Ima problem kada se ceo kupac stavi u sesiju.
    // Ovako se cuva samo id, a kada se trazi kupac
    // Pravi se objekat od tog id-a
    public static function buyer()
    {
    	$buyer_id = session('buyer_' . Store::url()->user->id . '/' . Store::url()->id);
        return Buyer::find($buyer_id);
    }


    public static function check()
    {
        // dd(Store::url()->user);
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

    // $data = array with email and password
    public static function attempt(array $data)
    {
    	$buyer = Buyer::where('email', $data['email'])->where('store_id', Store::url()->id)->first();

    	if (!$buyer) return false;

        if (!Hash::check($data['password'], $buyer->password)) return false;

        // Cuva se samo id kupca u sesiji
		session()->put('buyer_' . Store::url()->user->id . '/' . Store::url()->id, $buyer->id);
        static::cartFromSessionToDb($buyer);

        return true;

    }

    public static function register($data)
    {
        $data['password'] = bcrypt($data['password']);
        $buyer = Store::url()->buyers()->create($data);
        $cart = new Cart;
        $cart->store_id = Store::url()->id;
        $buyer->cart()->save($cart);
        static::cartFromSessionToDb($buyer);
    }


    public static function cart()
    {
        // Da li da vrati null ako buyer nije ulogovan
        // Ili da vrati cart iz sesije
        if (BAuth::guest()) {
            // return Cart::fromSession();
            return null;
        }
        return static::buyer()->cart;
    }



    // Metoda se nalazi ovde jer je vezana za buyera a ne samo za cart
    // Jedino se izvrsava kada se korisnik loguje
    private static function cartFromSessionToDb(Buyer $buyer)
    {
        $products = Cart::fromSession();
        foreach ($products as $product) {
            $currentProduct = $buyer->cart->products->where('id', $product->id)->first();
            if ($currentProduct) {
                $product->pivot->amount = max($product->pivot->amount, $currentProduct->pivot->amount);
            }
            $buyer->cart->products()->detach($product);
            $buyer->cart->products()->attach($product, ['amount' => $product->pivot->amount]);
        }
        Cart::emptyFromSession();
    }
}
