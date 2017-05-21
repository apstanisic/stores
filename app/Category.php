<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    // I am manually checking if field exist in database
    // because it needs to be unique but just for current
    // store, i don't want to see mobile_apple-534 in category
    // because everybody is using it and because i want to
    // category and parent be separated by underscore
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'generateSlug',
                'unique' => false,
                'method' => function ($string, $separator) {
                   //return strtolower(preg_replace('/[^a-z\-]+/i', $separator, $string));
                    return $string;
                }
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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class);
    }

    public static function url()
    {
        return \Route::input('category');
    }

    // Format is (parent->name . '_') name
    // print underscore only if parent exist
    // Words are separated by '-' and category
    // and parent by '_'
    public function getGenerateSlugAttribute()
    {
        $string = ($this->parent) ? str_slug($this->parent->name, '-') . '_' : '';
        $string .= str_slug($this->name, '-');

        $exists = $this->where('store_id', $this->store)
                       ->where('slug', $string)->first();

        if ($exists) {
            $i = 1;
            do {

                $tmpString .= '-' . $i++;
                $exists = $this->where('store_id', $this->store)
                               ->where('slug', $tmpString)->first();
                if (!$exists) $string = $tmpString;

            } while ($exists);
        }

        return $string;
    }
}
