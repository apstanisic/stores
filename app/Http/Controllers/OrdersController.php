<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidStatusRequest;
use App\Store;
use App\Order;
use App\Product;
use App\Status;

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

    // Owner doens't create order, he just edits it and deletes it
    // public function create()
    // public function store(Request $request)


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
        $status = Status::where('id', '!=', 6)->get();
        // Da izmeni status, ili porudzbinu
        return view('orders.edit', compact('order', 'status'));
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
        $status = $order->fullUpdate($request->except(['_token', '_method']));

        if ($status) session()->flash('flash_success', 'Uspesno izmenjena porudzbina');

        return redirect()->route('stores.orders.show', [$store->slug, $order->slug]);
    }



    public function updateStatus(ValidStatusRequest $request, Store $store, Order $order)
    {
        $order->update($request->all());

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
