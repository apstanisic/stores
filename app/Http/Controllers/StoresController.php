<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Stores;
use App\Http\Requests\StoreRequest;
use App\Category;
use App\Store;

class StoresController extends Controller
{

    private $stores;

	public function __construct(Stores $stores)
    {
        $this->stores = $stores;

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
        // dd((new \App\Repositories\Stores)->all(auth()->user()));
        // dd($this->stores->all());
        // $stores = auth()->user()->stores;
        $stores = $this->stores->all(auth()->user());
        // dd($this->stores->data);
        // return view('stores.index', compact('stores'));
        return view('stores.index', ['stores' => $stores->data]);
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
        // dd($request ->all());
        // $store = auth()->user()->stores()->create($request->all());
        // // Default category
        // $store->categories()->create(['name' => 'Nesvrstano']);

        $this->stores->create($request->all(), auth()->user());

        session()->flash('flash_success', 'Uspesno napravljena prodavnica');

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

        session()->flash('flash_success', 'Uspesno izmenjena prodavnica');

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

        session()->flash('flash_success', 'Uspesno izbrisana prodavnica');

        return redirect()->route('stores.index');
    }
}
