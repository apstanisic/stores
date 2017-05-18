<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BuyerRegisterRequest;
use App\BAuth;
use App\User;
use App\Store;

class BuyerController extends Controller
{

    public function __construct()
    {
        $this->middleware('bauth.guest')->except('logout');
        // $this->middleware('buyer')->only('logout');
    }

    public function showLoginForm(User $user, Store $store)
    {
    	//dd(BA::check($store));
    	return view('buyer.login');
    }

    public function login(Request $request, User $user, Store $store)
    {
    	//dd(request(['email', 'password']));
    	if (!BAuth::attempt(request(['email', 'password']))) {
    		return redirect()->back();
    	}

    	return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }

    public function showRegistrationForm(User $user, Store $store)
    {
    	return view('buyer.register');
    }

    public function register(BuyerRegisterRequest $request, User $user, Store $store)
    {
        BAuth::register($request->all());
        BAuth::attempt($request->all());

        return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }

    public function logout(User $user, Store $store)
    {
		BAuth::logout();

		return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }
}
