<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Store;
use App\Product;
use App\Category;

class ShoppingController extends Controller
{

    public function index(Store $store)
    {
        // dd(User::fromUrl());
        // dd($store);
    	return view('shopping.index')->with('products', $store->products()->latest()->paginate(12));
    }

    public function about(Store $store)
    {
        return view('shopping.about', compact('store'));
    }

    public function product(Store $store, Product $product)
    {
        return view('shopping.product', compact('product'));
    }

    public function category(Store $store, Category $category)
    {
        return view('shopping.category', ['products' => $category->products()->paginate()]);
    }

    public function categories(Store $store)
    {
        return view('shopping.categories', ['categories' => $store->categories]);
    }
}
