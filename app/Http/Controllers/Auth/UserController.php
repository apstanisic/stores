<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\DeleteProfileRequest;
use Session;

class UserController extends Controller
{


    /**
     * Apply correct middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display auth user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.user.index', ['user' => auth()->user()]);
    }


    /**
     * Show the form for editing logged user.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('auth.user.edit')->with('user', auth()->user());
    }


    /**
     * Update user profile.
     *
     * @param  \App\Http\Requests\UpdateUserProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        // TODO: FIXME: Kada se pravi profil moze da se napravi sa space-om
        auth()->user()->update(request(['username', 'email']));

        session()->flash('flash_success', 'Uspesno izmenjen profil');

        return redirect()->route('user.index')->with('user', auth()->user());
    }


    /**
     * Change logged user password
     *
     * @param App\Http\Requests\UpdatePasswordRequest $request
     * @return void
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->updatePassworrd(request('password'));

        session()->flash('flash_success', 'Uspesno izmenjena sifra');

        return redirect()->route('user.index')->with('user', auth()->user());
    }


    /**
     * Delete profile
     *
     * @param App\Http\Requests\DeleteProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteProfileRequest $request)
    {
        auth()->user()->delete();

        session()->flash('flash_success', 'Uspesno izbrisan profil');

        return redirect('/');
    }

}
