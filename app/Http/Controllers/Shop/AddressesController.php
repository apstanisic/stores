<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Address;
use App\Http\Requests\AddressRequest;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        $addresses = bauth($store)->user()->addresses;
        return view('shopping.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store)
    {
        return view('shopping.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request, Store $store)
    {
        bauth($store)->user()->addresses()->create($request->all());
        
        session()->flash('flash_success', 'Uspesno dodata adresa');
        
        return redirect()->route('shop.addresses.index', [$user->slug, $store->slug]);
    }

    // public function show(Store $store, Address $address)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Address $address)
    {
        return view('shopping.addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Store $store, Address $address)
    {
        $address->update($request->all());

        session()->flash('flash_success', 'Uspesno izmenjena adresa');
        
        return redirect()->route('shop.addresses.index', [$user->slug, $store->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Address $address)
    {
        $address->delete();
        
        session()->flash('flash_success', 'Uspesno izbrisana adresa');

        return redirect()->route('shop.addresses.index', [$user->slug, $store->slug]);
    }
}
