<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Store;
use App\Category;

class CategoriesController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('category.inStore')->except('index', 'create', 'store');
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
        $parents = $store->categories;
        return view('categories.create', compact('parents'));
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

        session()->flash('flash_success', 'Uspesno napravljena kategorija');

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
        $parentCategories = $store->categories;

        return view('categories.edit', compact('category', 'parentCategories'));
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

        session()->flash('flash_success', 'Uspesno izmenjena kategorija');

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

        session()->flash('flash_success', 'Uspesno izbrisana kategorija');

        return redirect()->route('stores.categories.index', [$store->slug]);
    }


    public function products(Store $store, Category $category)
    {
        $products = $store->products()->where('category_id', $category->id)->get();

        return view('products.index', compact('products'));
    }
}
