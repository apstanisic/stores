<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\User;
use App\Store;
use App\Product;
use App\Cart;

class CartController extends Controller
{

    /**
     * Show cart products and amounts
     *
     * @param App\Store $store
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        return view('shopping.cart', ['products' => Cart::items($store)]);
    }


    /**
     * Add, change product to cart
     *
     * @param App\Http\Requests\AddToCartRequest $request
     * @param App\Store $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    private function changeProduct(AddToCartRequest $request, Store $store, Product $product)
    {
        Cart::add($product, request('amount'));
        if ($request->isMethod('post')) {
            session()->flash('flash_success', 'Proizvod "' . $product->name . '" uspesno dodat u korpu.');
        } else {
            session()->flash('flash_success', 'Proizvod "' . $product->name . '" uspesno izmenjen u korpi.');
        }

        return redirect()->back();
    }


    /**
     * Remove product from cart
     *
     * @param Request $request
     * @param App\Store $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Store $store, Product $product)
    {
        Cart::removeItem($product);

        return redirect()->back();
    }

    /**
     * Empty cart
     *
     * @param Request $request
     * @param AppStore $store
     * @return \Illuminate\Http\Request
     */
    public function destroyAll(Request $request, Store $store)
    {
        Cart::removeAll($store);

        return redirect()->back();
    }
}
