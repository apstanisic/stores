<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Store;
use Auth;
use Session;

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
    	/* Isto kao nacin ispod, neka sluzi kao podsetnik
    	*  Kako sve moze
        $store = new Store($request->all());
        Auth::user()->stores()->save($store);
		*/
        $store = Auth::user()->stores()->create($request->all());
        
        Session::flash('flash_success', 'Uspesno napravljena prodavnica');
        
        return redirect()->route('stores.show', [$store->id]);
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

        Session::flash('flash_success', 'Uspesno izmenjena prodavnica');

        return redirect()->route('stores.show', [$id]);
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
