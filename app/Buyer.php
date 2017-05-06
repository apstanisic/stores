<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username', 'email', 'password',
    ];

	protected $hidden = [
        'password'//, 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    // session()->put('buyer_user/store')
}
