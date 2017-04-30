<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Store;
use App\Product;

class CartController extends Controller
{

    public function index(User $user, Store $store)
    {
        // $products =
        $tmpSessions = session('cart_' . $user->id . '/' . $store->id);
        $products = [];
        foreach ($tmpSessions as $key => $value) {
            $products[] = Product::where('name', $key)->first();
        }
        dd($products);
        return view('shopping.cart');
    }

    public function store(Request $request, User $user, Store $store, Product $product)
    {

        $this->validate(request(), [
            'amount' => 'required'
        ]);
        // Session name is based on user and store
        $session_name = 'cart_' . $user->id . '/' . $store->id;
        // Get all sessions with the name in to array
        $tmpSessions = session($session_name);
        // Add to array new item, or replace existing, where
        // key is product name and value is amount
        if(request('amount') === '+1'){
            $tmpSessions[$product->name] = isset($tmpSessions[$product->name]) ? ++$tmpSessions[$product->name] : 1;
        } else {
            $tmpSessions[$product->name] = intval(request('amount'));
        }
        // Put array back into sessions
        session()->put($session_name, $tmpSessions);
        Session::flash('flash_success', 'Proizvod "' . $product->name . '" uspesno dodat u korpu.');
        return redirect()->back();
    }


    public function destroy(Request $request, User $user, Store $store, Product $product)
    {
        $session_name = 'cart_' . $user->id . '/' . $store->id;
        $tmpSessions = session($session_name);
        unset($tmpSessions[$product->name]);
        session()->put($session_name, $tmpSessions);

        return redirect()->back();
    }
}
