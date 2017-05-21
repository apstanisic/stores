<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Store;
use App\Product;
use App\Category;

class ShoppingController extends Controller
{
    public function index(User $user, Store $store)
    {
    	return view('shopping.index')->with('products', $store->products()->paginate());
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
        return view('shopping.category', ['products' => $category->products()->paginate()]);
    }

    public function categories(User $user, Store $store)
    {
        $categories = $store->categories;
        return view('shopping.categories', compact('categories'));
    }
}
