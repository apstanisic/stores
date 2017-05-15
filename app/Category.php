<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['parent.name', 'name'],
                'unique' => false
            ]
        ];
    }

    // Route model binding sa slugom, a ne sa id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'name', 'parent_id'
    ];

    public $timestamps = false;


    public function products() {
        return $this->hasMany(Product::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class);
    }

    public static function url()
    {
        return \Route::input('category');
    }
}
