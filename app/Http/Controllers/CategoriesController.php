<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Store;
use App\Category;
use Route;
use Session;

class CategoriesController extends Controller
{

	private $store;

	// Mozda bolje ovo negu u dve metode da se dohvataju kategorije
	//private $parents = $this->store->categories;


    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('categoryInStore')->except('index', 'create', 'store');

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
    	/*
    	Ako hocu samo glavne kategorije
    	where('parent_id', null);
		*/

		// Sve kategorije koje mogu da budu roditelji
		// Napravljene kategorije
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
        $this->store->categories()->create($request->all());

        Session::flash('flash_success', 'Uspesno napravljena kategorija');

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
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($store, $id)
    {
        $parents = $this->store->categories;

        $category = Category::findOrFail($id);

        return view('categories.edit', compact('parents', 'category'));
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
        $category = Category::findOrFail($id);

        $category->update($request->all());

        Session::flash('flash_success', 'Uspesno izmenjena kategorija');

        return redirect()->route('categories.show', [$store, $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($store, $id)
    {
        Category::destroy($id);

        Session::flash('flash_success', 'Uspesno izbrisana kategorija');

        return redirect()->route('categories.index', [$store]);
    }


    public function products($store, $id)
    {
    	// Lists all products from selected category
    }
}
