<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
    * Korisnik moze da ima vise prodavnica
    */
    public function stores () {
        return $this->hasMany('App\Store');
    }

    public function isStoreOwner ($store) {

        // Dohvata prodavnicu
        $store = Store::find($store);

        // Ako nema prodavnice vraca false
        if(!$store) {
            return false;
        }

        // Ako ulogovani korisnik nije vlasnik vraca false
        if($store->user->id !== Auth::id()){
           return false;
        }

        // Ako je vlasnik vraca true
        return true;
        
    }
}
