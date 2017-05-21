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


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.user.index', ['user' => auth()->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('auth.user.edit')->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        // Update user profile
        // FIXME
        // Kada se pravi profil moze da se napravi sa space-om
        auth()->user()->update(request(['username', 'email']));

        session()->flash('flash_success', 'Uspesno izmenjen profil');

        return redirect()->route('user.index')->with('user', auth()->user());
    }

    public function updatePassword(updatePasswordRequest $request)
    {
        auth()->user()->updatePassworrd(request('password'));

        session()->flash('flash_success', 'Uspesno izmenjena sifra');

        return redirect()->route('user.index')->with('user', auth()->user());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteProfileRequest $request)
    {
        auth()->user()->delete();

        session()->flash('flash_success', 'Uspesno izbrisan profil');

        return redirect('/');
    }

}
