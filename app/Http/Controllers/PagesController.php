<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'index']);
    }
    public function index () {
        $format = [
            'hideLabel' => true,
            'large' => true,
            'placeholder' => true
        ];

    	return view('pages.welcome', compact('format'));
    }


    public function prices () {
    	return view('pages.prices');
    }


    public function whyUs () {
    	return view('layouts.master');
    }

    public function guides () {
    	return view('pages.guides');
    }

    public function contact () {
    	return view('layouts.master');
    }

    public function users () {
    	return view('layouts.master');
    }


}
