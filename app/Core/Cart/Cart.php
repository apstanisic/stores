<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Store;
use App\Core\Repositories\Cart\GuestCart;
use App\Core\Repositories\Cart\AuthCart;

class Cart
{

    /**
     * Get instance of right cart, AuthCart if user is logged in,
     * and GuestCart if user isn't
     *
     * @param Store $store
     * @return void
     */
    private static function instance(Store $store)
    {    
        if (bauth($store)->check()) {
            return new AuthCart($store);
        } else {
            return new GuestCart($store);
        }
    }


    /**
     * Get all products in cart
     *
     * @param Store $store
     * @return Array App\Product
     */
    public static function items(Store $store)
    {
        $cart = Cart::instance($store);

        return $cart->items();
    }


    /**
     * Get price of all items in cart  
     *
     * @param App\Store $store - if store is not passed it will take store from url
     * @return double
     */
    public static function price(Store $store = null)
    {
        if ($store === null) {
            $store = Store::fromUrl();
        }

        $price = 0;

        foreach (Cart::items($store) as $product) {
            $price += $product->pivot->amount * $product->price;
        }

        return $price;
    }

    /**
     * Add or update product in cart
     *
     * @param App\Product $product
     * @param integer $amount
     * @param boolean $replace should $amount replace current 
     *                         amount or calculate it if product exist in cart
     * @return void
     */
    public static function add(Product $product, int $amount, bool $replace = true)
    {
        $amount = $product->requestedOrMax($amount);

        if ($amount == 0) {
            return false;
        }

        $cart = Cart::instance($product->store);
        $cart->add($product, $amount, $replace);
    }

    /**
     * Remove product from cart
     *
     * @param App\Product $product
     * @return void
     */
    public static function remove(Product $product)
    {
        $cart = Cart::instance($product->store);
        $cart->remove($product);
    }

    /**
     * Remove all products from cart
     *
     * @param App\Store $store
     * @return void
     */
    public static function removeAll(Store $store = null)
    {
        if ($store === null) {
            $store = Store::fromUrl();
        }

        $cart = Cart::instance($store);
        $cart->removeAll($store);
    }


    /**
     * Update product in cart
     *
     * @param App\Product $product
     * @param integer $amount
     * @return void
     */
    public static function update(Product $product, int $amount)
    {
        Cart::add($product, $amount, true);
    }


}
