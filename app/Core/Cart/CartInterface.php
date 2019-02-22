<?php

namespace App\Core\Repositories\Cart;

use App\Product;
use App\Store;

interface CartInferface {

    public static function add(Product $product, int $amount, bool $replace);

    public static function remove(Product $product);

    public static function removeAll(Store $store);

    public static function items(Store $store);

    // public static function productAmount(Product $product);
}