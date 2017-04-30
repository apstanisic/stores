<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Product;

class ShoppingController extends Controller
{
    public function index(User $user, Store $store)
    {
    	return view('shopping.index', compact('products', 'user', 'store'))->with('products', $store->products);
    }

    public function about()
    {

    }

    public function product(User $user, Store $store, Product $product)
    {

    }

    public function category(User $user, Store $store, Category $category)
    {

    }

    public function categories()
    {

    }
}
