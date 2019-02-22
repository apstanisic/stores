<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateRemainingProductsRequest;
use Route;
use App\Store;
use App\Product;
use Session;

class ProductsController extends Controller
{

    /**
     * Set correct middleware
     *
     * @param Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('product.inStore')->except('index', 'create', 'store');
    }


    /**
     * Show products 
     *
     * @param App\Store $store
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {

        $products = $store->products()->latest()->paginate(12);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @param App\Store $store
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store)
    {
        return view('products.create', ['categories' => $store->categories]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Store $store)
    {
        $store->products()->create($request->all());

        Session::flash('flash_success', 'Uspesno dodat proizvod');

        return redirect()->route('stores.products.index', [$store->slug]);
    }

    /**
     * Display the specified product.
     *
     * @param  App\Store  $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param App\Store $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Product $product)
    {
        return view('products.edit')->with('categories', $store->categories)
                                    ->with('product', $product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param \App\Http\Requests\ProductRequest  $request
     * @param App\Store  $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Store $store, Product $product)
    {
        $product->update($request->all());


        Session::flash('flash_success', 'Uspesno izmenjen proizvod');

        return redirect()->route('stores.products.show', [$store->slug, $product->slug]);
    }

    /**
     * Remove the specified product from storage.
     * 
     * @param App\Store  $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Product $product)
    {
        $product->delete();

        Session::flash('flash_success', 'Uspesno izbrisan proizvod');

        return redirect()->route('stores.products.index', [$store->slug]);
    }

    /**
     * Update amount of product in stock.
     *
     * @param App\Http\Requests\UpdateRemainingProductsRequest $request
     * @param App\Store $store
     * @param App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function updateRemaining(UpdateRemainingProductsRequest $request, Store $store, Product $product)
    {
        $product->addRemaining($request->remaining);
        session()->flash('flash_success', 'Uspesno izmenjeni proizvodi na stanju');
        return redirect()->back();
    }
}
