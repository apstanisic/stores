<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
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
        return view('auth.user.index')->with('user', auth()->user());
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

        Session::flash('flash_success', 'Uspesno izmenjen profil');

        return redirect()->route('user.index')->with('user', auth()->user());
    }

    public function updatePassword(UpdateProfileRequest $request)
    {
        $password = bcrypt(request('password'));
        auth()->user()->update(compact('password'));

        Session::flash('flash_success', 'Uspesno izmenjena sifra');

        return redirect()->route('user.index')->with('user', auth()->user());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return 'Nije omoguceno brisanje korisnika, uskoro!';

        auth()->user()->delete();

        Session::flash('flash_success', 'Uspesno izbrisan profil');

        return redirect()->url('/');
    }

}
