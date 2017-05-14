<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Order;
use App\Cart;
use App\BAuth;
use App\Product;

class BuyerOrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('bauth');
        $this->middleware('buyer.order.owner')->except(['index', 'store']);
        $this->middleware('buyer.order.canEdit')->only(['destroy', 'edit', 'update', 'togglePause']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Store $store)
    {
        $orders = BAuth::buyer()->orders()->latest()->get();
        return view('buyer.orders.index', compact('orders'));
    }
    /* Ne treba da postoji stranica, vec u korpi postoji link koji pravi order */
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(User $user, Store $store)
    // {
    //     // Dati sadrzaj cart-a da korisnik potvrdi
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Store $store, Request $request)
    {
        // snimi narudzbinu
        //dd(Cart::price());
        // dd(Orde)
        if (!Cart::isEmpty()) {
            //dd(Cart::isEmpty());
            session()->flash('flash_danger', 'Korpa je prazna');
            return redirect()->back();
        }
        $order = new Order;
        $order->buyer_id = BAuth::buyer()->id;
        $order->store_id = $store->id;
        $order->price = Cart::price();
        $order->save();

        foreach (Cart::items() as $product) {
            // BAuth::buyer()->cart->products()->attach($product->id, ['amount' => $amount]);
            $order->products()->attach($product->id, ['amount' => $product->pivot->amount]);
        }
        Cart::emptyCart();
        return redirect()->route('buyer.orders.index', [$user->id, $store->id]);

        //Order::store
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Store $store, Order $order)
    {
        return view('buyer.orders.show', compact('order'));
        // Prikazi narudzbinu
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Store $store, Order $order)
    {
        return view('buyer.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Store $store, Order $order)
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
        return redirect()->route('buyer.orders.index', [$user->id, $store->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Store $store, Order $order)
    {
        // if ($order->status->name == 'u_pripremi' || $order->status->name == 'pauzirano') {
            $order->products()->detach();
            $order->status_id = 7;
            $order->save();
            $order->delete();
            session()->flash('flash_success', 'Uspesno ste odustali od porudzbine');
        // } else {
        //     session()->flash('flash_danger', 'Nije moguce odustati od porudzbine');
        // }
        return redirect()->route('buyer.orders.index', [$user->id, $store->id]);
    }

    // If order isn't sent it will be paused
    // if order is paused it will be unpaused
    // and set in preparation
    public function togglePause(User $user,Store $store, Order $order)
    {
        if ($order->status->name == 'u_pripremi') {
            $order->status_id = 6;
            $order->save();
            session()->flash('flash_success', 'Uspesno pauzirano');
        }
        if ($order->status->name == 'pauzirano') {
            $order->status_id = 1;
            $order->save();
            session()->flash('flash_success', 'Uspesno ste zaustavili pauzu, posiljka je opet u pripremi');
        }
        return redirect()->back();
    }
}
