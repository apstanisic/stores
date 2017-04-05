<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\Store;
use App\Product;

class ProductController extends Controller
{

    /*
        Svaki proizvod ima prodavnicu kojoj pripada
        Svaka metoda ima pristup toj prodavnici
        Vrednost se stavlja u konstruktoru
    */

    private $productStore;



    public function __construct(Request $request) 
    {
        $this->middleware(['auth', 'owner']);

        /**
         * TODO : napravi nadkontroler za sve kontrolere koje imaju store u url
         * Dohvata store jer svaka metoda ime store, dohvata iz url-a.  
         * Proverava se $request->route() jer prilikom route:list
         * ne Route::input, tako da mora prvo da se proveri
         */

        if ($request->route()) {
            $this->productStore = Store::findOrFail(Route::input('store'));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($store)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $store)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($store, $id)
    {
        $product = Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($store, $id)
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
    public function update(Request $request,$store, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($store, $id)
    {
        //
    }
}
