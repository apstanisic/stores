<?php

// namespace App\Helpers;

use App\Core\Auth\BuyerAuth;
use App\Store;

function bauth(Store $store = null)
{
    if ($store === null) {
        $store = Store::fromUrl()->first();
    }
    return (new BuyerAuth($store));
}