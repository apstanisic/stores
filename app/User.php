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
        return $this->hasMany(Store::class);
    }

    public function roles() {
    	return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Store::class);
    }

    public function productsCount()
    {
        // Bolje za bazu nego da se dohvataju svi pa da se onda broji
        return $this->products()->count();
    }

    public function isStoreOwner ($store) {

        // Dohvata prodavnicu kojoj je vlasnik i ima
        // id koji je prosledjen u url-u
        $store = Store::isOwner()->find($store);

        // Ako nema prodavnice vraca false
        if(!$store) {
            return false;
        }

        // Ako je vlasnik vraca true
        return true;

    }
}
