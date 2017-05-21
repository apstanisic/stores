<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
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
        return view('shopping.cart', ['products' => Cart::items($store)]);
    }

    public function store(AddToCartRequest $request, User $user, Store $store, Product $product)
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
        Cart::removeAll($store);

        return redirect()->back();
    }
}
