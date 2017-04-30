<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Product;
use App\Category;

class ShoppingController extends Controller
{
    public function index(User $user, Store $store)
    {
    	return view('shopping.index')->with('products', $store->products);
    }

    public function about(User $user, Store $store)
    {
        return view('shopping.about');
    }

    public function product(User $user, Store $store, Product $product)
    {
        return view('shopping.product', compact('product'));
    }

    public function category(User $user, Store $store, Category $category)
    {
        $products = $category->products;
        return view('shopping.category', compact('products'));
    }

    public function categories(User $user, Store $store)
    {
        $categories = $store->categories;
        return view('shopping.categories', compact('categories'));
    }
}
