<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index ()
    {
        if (auth()->check()) {
            return redirect()->route('stores.index');
        } else {
            return view('pages.welcome');
        }
    }

}
