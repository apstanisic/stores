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

    public function about ()
    {
    	return view('pages.about');
    }

}
