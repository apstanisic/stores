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
        $this->middleware('bauth.guest')->except(['logout', 'index']);
        // $this->middleware('buyer')->only('logout');
    }

    public function index(Store $store) {
        $buyer = bauth($store)->user();
        return view('bauth.user.index', compact('buyer'));
    }

    public function showLoginForm(Store $store)
    {
    	return view('bauth.login');
    }

    public function login(Request $request, Store $store)
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

    public function showRegistrationForm(Store $store)
    {
    	return view('bauth.register');
    }

    public function register(BuyerRegisterRequest $request, Store $store)
    {
        // $buyer = BAuth::register($request->all(), $store);
        $buyer = bauth($store)->register($request->all());
        bauth($store)->login($buyer);
        // BAuth::login($buyer);

        return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }

    public function logout(Store $store)
    {
		// BAuth::logout($store);
        bauth($store)->logout();

		return redirect()->route('shopping.index', [$user->slug, $store->slug]);
    }
}
