<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use Session;
use App\User;
use App\Store;
use App\Product;
use App\Cart;
use App\BAuth;

class CartController extends Controller
{

    public function index(User $user, Store $store)
    {
        $products = Cart::items();
        return view('shopping.cart', compact('products'));
    }

    public function store(CartRequest $request, User $user, Store $store, Product $product)
    {
        Cart::add($product, request('amount'));

        Session::flash('flash_success', 'Proizvod "' . $product->name . '" uspesno dodat u korpu.');

        return redirect()->back();
    }


    public function destroy(Request $request, User $user, Store $store, Product $product)
    {
        Cart::removeItem($product);

        return redirect()->back();
    }

    public function destroyAll(Request $request, User $user, Store $store)
    {
        Cart::emptyCart();

        return redirect()->back();
    }
}
