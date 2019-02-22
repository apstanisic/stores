<?php

namespace App\Core\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
use App\Store;
use App\Cart;

class BuyerAuth extends Model
{
    // When logging in it will check this field with provided password
    // Recommended username, email or slug but you can set anything you want
    private static $field = 'email';
    private $store;

    public function __construct(Store $store)
    {
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
        return !$this->check();
    }

    // Logs out buyer
    public function logout()
    {
        session()->forget('buyer_' . $this->store->id);
    }

    // Check if data is valid
    // $data = array with field (email, username, slug, etc) and password
    public function attempt(array $data)
    {
        // Gets buyer where predefined field is equal to array value
        $buyer = $this->store->buyers->where(static::$field, $data[static::$field])->first();

        if (!$buyer) return false;

        // Check if password is valid
        if (!\Hash::check($data['password'], $buyer->password)) return false;

        $this->login($buyer);

        return true;

    }

    // Creates user
    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $buyer = $this->store->buyers()->create($data);

        return $buyer;
    }

    // Store only id, there is a problem when storing buyer object
    public function login(Buyer $buyer)
    {
        session()->put('buyer_' . $this->store->id, $buyer->id);
        // TODO: this shouldn't exist
        $this->cartFromSessionToDb($buyer);
    }

}
