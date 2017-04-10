<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Store;
use Route;

class CategoriesController extends Controller
{

	private $store;


    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);

        if ($request->route()) {
            $this->store = Store::findOrFail(Route::input('store'));
        }
        // Ovako se deli var sa svim view-ima
        // view()->share('store', $this->store);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store)
    {
    	$categories = $this->store->categories;

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($store)
    {
    	$parents = $this->store->categories;

        return view('categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, $store)
    {
        // echo 'Radi';
        $this->store->categories()->create($request->all());

        return redirect()->route('categories.index', [$this->store->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($store, $id)
    {
        //
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
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $store, $id)
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


    public function products($store, $id)
    {
    	// Lists all products from selected category
    	
    }
}
