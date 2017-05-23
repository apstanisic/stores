<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyerRegisterRequest;
// use App\BAuth;
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
    	return view('bauth.login');
    }

    public function login(Request $request, User $user, Store $store)
    {
    	//dd(request(['email', 'password']));
    	// if (!BAuth::attempt(request(['email', 'password']), $store)) {
    	// 	return redirect()->back();
    	// }
        if (!bauth($store)->attempt(request(['email', 'password']))) {
            return redirect()->back();
        }

    	return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }

    public function showRegistrationForm(User $user, Store $store)
    {
    	return view('bauth.register');
    }

    public function register(BuyerRegisterRequest $request, User $user, Store $store)
    {
        // $buyer = BAuth::register($request->all(), $store);
        $buyer = bauth($store)->register($request->all());
        bauth($store)->login($buyer);
        // BAuth::login($buyer);

        return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }

    public function logout(User $user, Store $store)
    {
		// BAuth::logout($store);
        bauth($store)->logout();

		return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }
}
