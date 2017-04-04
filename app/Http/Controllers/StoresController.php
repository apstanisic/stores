<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Store;
use Auth;

class StoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('owner')->except('index', 'create', 'store');
    }
    /**
     * Prikazuje sve korisnikove prodavnice
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::where('user_id', 1)->get();
        return view('stores.all', compact('stores'));
    }

    /**
     * Forma za pravljenje nove prodavnice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Pravi novu prodavnicu u bazi.
     *
     * @param  App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = new Store($request->all());
        Auth::user()->stores()->save($store);
        return redirect('/stores/create');
    }

    /**
     * Prikazuje odredjenu prodavnicu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.show', compact('store'));
    }

    /**
     * Forma za izmenu odredjene prodavnice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.edit', compact('store'));
    }

    /**
     * Menja prodavnicu u bazi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);

        $store->update($request->all());

        return redirect("stores/{$id}");
    }

    /**
     * Brise prodavnicu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::destroy($id);
        return redirect()->route('stores.index');
    }
}
