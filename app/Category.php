<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
 
    
    protected $fillable = [
        'name', 'parent_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }


    public function products() 
    {
        return $this->hasMany(Product::class);
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function parent() {
        return $this->belongsTo(Category::class);
    }



    /**
     * Recursivly get all parents of category
     * Allow for $this->parents instead of $this->parents()
     *
     * @return Array App\Category
     */
    public function getParentsAttribute()
    {
        $parents = [];
        if ($this->parent !== null) {
            $parents[] = $this->parent;
            $parents = array_merge($parents, $this->parent->parents());
        }
        return $parents;
    }


    /**
     * Get all direct children categories
     *
     * @return Builder
     */
    public function getChildrenAttribute()
    {
        return Category::where('parent_id', $this->id);
    }


}
