<?php

use App\BAuth;
use App\Store;

function bauth(Store $store = null) {
	return (new BAuth($store));
}