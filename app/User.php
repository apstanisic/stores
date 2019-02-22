<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\User;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

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
    
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * This method is used for model specific settings 
     * on generating slug.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username',
                'onUpdate' => true,
            ]
        ];
    }

    /**
     * User has many stores
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores() 
    {
        return $this->hasMany(Store::class);
    }

}
