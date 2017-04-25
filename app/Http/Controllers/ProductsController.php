<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Route;
use App\Store;
use App\Product;
use Session;

class ProductsController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('productInStore')->except('index', 'create', 'store');

        /*
			Uradjen route model binding
        */

        /**
         * DONE : napravi nadkontroler za sve kontrolere koje imaju store u url
         * Dohvata store jer svaka metoda ime store, dohvata iz url-a.
         * Proverava se $request->route() jer prilikom route:list
         * ne Route::input, tako da mora prvo da se proveri
         */

        //
        // if ($request->route()) {
        //     $this->store = Store::findOrFail(Route::input('store'));
        // }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {

        $products = $store->products()->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store)
    {
        $categories = $store->categories;
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Store $store)
    {
        $store->products()->create($request->all());

        Session::flash('flash_success', 'Uspesno dodat proizvod');

        return redirect()->route('stores.products.index', [$store->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Product $product)
    {
        $categories = $store->categories;

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Store $store, Product $product)
    {
        $product->update($request->all());

        Session::flash('flash_success', 'Uspesno izmenjen proizvod');

        return redirect()->route('stores.products.show', [$store->id, $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Product $product)
    {
        $product->delete();

        Session::flash('flash_success', 'Uspesno izbrisan proizvod');

        return redirect()->route('stores.products.index', [$store->id]);
    }
}
