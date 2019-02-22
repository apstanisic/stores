<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Store;

class StoresController extends Controller
{
    /**
     * Set correct middleware
     *
     * @param Illuminate\Http\Request $request
     */
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('owner')->except('index', 'create', 'store');
    }


    /**
     * Show stores 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = auth()->user()->stores;
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('stores.create');
    }

    /**
     * Creates new store in database
     */
    public function store(StoreRequest $request)
    {
        $store = auth()->user()->stores()->create($request->all());

        session()->flash('flash_success', 'Successfuly created store');

        return redirect()->route('stores.show', [$store->slug]);
    }

    /**
     * Show store by slug
     */
    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

    /**
     * Form for editing store
     */
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    /**     
     * Changes store in db
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());

        session()->flash('flash_success', 'Uspesno izmenjena prodavnica');

        return redirect()->route('stores.show', [$store->slug]);
    }

    /**
     * Deletes selected store
     */
    public function destroy(Store $store)
    {
    	$store->delete();

        session()->flash('flash_success', 'Uspesno izbrisana prodavnica');

        return redirect()->route('stores.index');
    }
}
