<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Category;
use App\Store;
use Session;
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
        $stores = Store::isOwner()->get();
        return view('stores.index', compact('stores'));
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
        $store = Auth::user()->stores()->create($request->all());
        // Default category
        $store->categories()->create(['name' => 'Nesvrstano']);

        Session::flash('flash_success', 'Uspesno napravljena prodavnica');

        return redirect()->route('stores.show', [$store->slug]);
    }

    /**
     * Prikazuje odredjenu prodavnicu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

    /**
     * Forma za izmenu odredjene prodavnice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    /**     * Menja prodavnicu u bazi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());

        Session::flash('flash_success', 'Uspesno izmenjena prodavnica');

        return redirect()->route('stores.show', [$store->slug]);
    }

    /**
     * Brise prodavnicu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
    	$store->delete();

        Session::flash('flash_success', 'Uspesno izbrisana prodavnica');

        return redirect()->route('stores.index');
    }
}
