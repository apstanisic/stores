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

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('store.haveCategory')->except('index', 'create', 'store');
        // Treba ako se prosledjuje id store, a ne objekat
        // if ($request->route()) {
        //     $this->store = Store::findOrFail(Route::input('store'));
        // }
        // Ovako se deli var sa svim view-ima
        // view()->share('store', $store);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
    	$categories = $store->categories;

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Should user be able to nest indefinetly?
    // If not ->where('parent_id', null);
    public function create(Store $store)
    {
        return view('categories.create', ['parents' => $store->categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Store $store)
    {
        $store->categories()->create($request->all());

        Session::flash('flash_success', 'Uspesno napravljena kategorija');

        return redirect()->route('stores.categories.index', [$store->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Category $category)
    {
        $parents = $store->categories;

        return view('categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Store $store, Category $category)
    {
        $category->update($request->all());

        Session::flash('flash_success', 'Uspesno izmenjena kategorija');
        return redirect()->route('stores.categories.show', [$store->slug, $category->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Category $category)
    {
        $category->delete();

        Session::flash('flash_success', 'Uspesno izbrisana kategorija');

        return redirect()->route('stores.categories.index', [$store->slug]);
    }


    public function products(Store $store, Category $category)
    {
        $products = $store->products()->where('category_id', $category->id)->get();

        return view('products.index', compact('products'));
    }
}
