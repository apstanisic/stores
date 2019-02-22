<?php

namespace App\Core\Repositories\Cart;

use App\Core\Repositories\CartInferface;
use App\Product;
use App\Store;

class GuestCart implements CartInferface
{
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
        $this->cartName = 'cart_' . $store->id;
    }

    private function itemsRaw()
    {
        return session($this->cartName);
    }
    

    /**
     * Add product to session cart.
     * Products are stored in format $array[product_slug] = $amount
     *
     * @param App\Product $product
     * @param integer $amount
     * @param boolean $replace
     * @return void
     */
    public function add(Product $product, int $amount, bool $replace = true)
    {
        if ($amount < 1) {
            return;
        }
        
        $products = $this->itemsRaw();

        if (!$replace) {
            $amount += $products[$product->id];
        }

        $products[$product->id] = $amount;
        session()->put($this->cartName, $products);
    }

    public function remove(Product $product)
    {
        $products = $this->itemsRaw();
        unset($products[$product->id]);
        session()->put($this->cartName, $products);
    }

    public function removeAll()
    {
        session()->forget($this->cartName);
    }

    public function items()
    {
        $sessionProducts = $this->itemsRaw() ?? [];
        $products = [];

        foreach ($sessionProducts as $id => $amount) {
            $product = Product::where('store_id', $this->store->id)
                ->where('id', $id)->first();
            $product->pivot = (object)['amount' => $amount];
            $products[] = $product;
        }

        return collect($products);
    }

    
}