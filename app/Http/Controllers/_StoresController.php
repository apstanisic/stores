<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateStoreRequest;
use App\Store;

class _StoresController extends Controller
{

	/*
	Pocetna admin za prodavnice
	*/
	public function index() {

		$stores = Store::where('user_id', 1)->get();
		return view('dashboard.stores', compact('stores'));

	}

	/*
	Pocetna za odredjenu prodavnicu
	*/
	public function show($user, $store) {
		// Ako nema prodavnice bazi gresku
	}


	/*
	Forma za pravljenje nove prodavnice
	*/
	public function create() {
		return view('dashboard.stores');
	}


	/*
	Pravi novu prodavnicu
	*/
    public function store(CreateStoreRequest $request) {
    	$input = $request->all();
    	$input['user_id'] = 1;
    	
    	Store::create($input);

    	return redirect('/stores/create');
    	
    }

    public function destroy($id) {
    	return 'Izbrisana ' . $id . 'prodavnica';
    }
}
