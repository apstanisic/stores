<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\Store;
use App\Product;

class ProductsController extends Controller
{





    public function __construct(Request $request) 
    {
        $this->middleware(['auth', 'owner']);

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Store $store)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, $id)
    {
        $product = Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, $id)
    {
        //
    }
}
