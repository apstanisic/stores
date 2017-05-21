<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Order;
use App\Product;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'owner']);
        $this->middleware('store.haveOrder')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        $orders = $store->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     // Ne treba? Mozda ako ima neki problem
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // Ne treba?
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Order $order)
    {
        //
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Order $order)
    {
        // Da izmeni status, ili porudzbinu
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store, Order $order)
    {
        $order->products()->detach();
        $price = 0;
        foreach (request()->all() as $product_id => $amount) {
            $product = Product::find($product_id);
            if ($amount > 0 && $product->store->id == $store->id) {
                $order->products()->attach($product_id, ['amount' => intval($amount)]);
                $price += $product->price * $amount;
            }
        }

        if (!count($order->products)) {
            $order->delete();
            session()->flash('flash_success', 'Izbrisali ste sve proizvode iz porudzbine, porudzbina je obrisana');
        } else {
            $order->price = $price;
            $order->save();
            session()->flash('flash_success', 'Porudzbina je uspesno izmenjena');
        }
        return redirect()->route('stores.orders.show', [$store->slug, $order->slug]);
    }

    public function updateStatus(Request $request, Store $store, Order $order)
    {
        $this->validate($request, [
            'status_id' => 'exists:status,id'
        ]);

        $order->status_id = request('status_id');
        $order->save();
        session()->flash('flash_success', 'Uspesno izmenjen status');
        return redirect()->route('stores.orders.show', [$store->slug, $order->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store, Order $order)
    {
        $order->fullDelete();

        session()->flash('flash_success', 'Uspesno ste izbrisali porudzbinu');

        return redirect()->route('stores.orders.index', [$store->slug]);
    }
}
