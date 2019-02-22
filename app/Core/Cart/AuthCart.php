<?php

namespace App\Core\Repositories\Cart;

use App\Core\Repositories\CartInferface;
use App\Product;
use Symfony\Component\HttpKernel\HttpCache\Store;

class AuthCart implements CartInferface
{
    private $store;

    public function __construct(Store $store) {
        $this->store = $store;
    }

    public function add(Product $product, int $amount, bool $replace = true)
    {
        if ($amount < 1) {
            return;
        }
        
        if (!$replace) {
            $cartProduct = bauth($product->store)->cart()->products()
                        ->where('id', $product->id)
                        ->first();

            if ($cartProduct) {
                $amount += $cartProduct->pivot->amount;
            }

        }
        bauth($product->store)->cart()->products()->detach($product->id);
        bauth($product->store)->cart()->products()->attach($product->id, ['amount' => $amount]);
    }

    public function remove(Product $product)
    {
        bauth($product->store)->cart()->products()->detach($product->id);
    }

    public function removeAll()
    {
        bauth($this->store)->cart()->products()->detach();
    }

    public function items()
    {
        return bauth($this->store)->user()->cart_items;
    }
    


}