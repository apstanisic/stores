<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'index']);
    }

    public function index ()
    {
    	return view('pages.welcome');
    }

    public function whyUs ()
    {
    	return view('layouts.master');
    }

    public function guides ()
    {
    	return view('layouts.master');
    }

    public function contact ()
    {
    	return view('layouts.master');
    }

    // public function users ()
    // {
    // 	return view('layouts.master');
    // }


}
