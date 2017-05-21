<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function stores() {
        return $this->hasMany(Store::class);
    }

    public function roles() {
    	return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Store::class);
    }

    public function updatePassword($password)
    {
        $this->update(['password' => bcrypt($password)]);
    }

    // Bolje za bazu nego da se dohvataju svi pa da se onda broji
    public function productsCount()
    {
        return $this->products()->count();
    }

    // Check if passed store belongs to user
    public function isStoreOwner (Store $store) {
        if ($store->user->id !== $this->id) {
            return false;
        } else {
            return true;
        }
    }

    public static function url()
    {
        return \Route::input('user');
    }
}
