<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BAuth;
use App\User;
use App\Store;

class BuyerController extends Controller
{
    public function showLoginForm(User $user, Store $store)
    {
    	//dd(BA::check($store));
    	return view('buyer.login');
    }

    public function login(Request $request, User $user, Store $store)
    {
    	//dd(request(['email', 'password']));
    	if (!BAuth::attempt(request(['email', 'password']), $store)) {
    		return redirect()->back();
    	}

    	return redirect()->route('shopping.index', [$user->id, $store->id]);
    }

    public function showRegistrationForm(User $user, Store $store)
    {
    	return view('buyer.register');
    }

    public function register(User $user, Store $store)
    {

    }

    public function logout(User $user, Store $store)
    {
		BAuth::logout();

		return redirect()->route('shopping.index', [$user->id, $store->id]);
    }
}
