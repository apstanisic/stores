<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Order extends Model
{
    use SoftDeletes;
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'generateSlug',
                'unique' => true
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $dates = ['deleted_at'];

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('amount')->withTimestamps();
    }

    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    public function store()
    {
    	return $this->belongsTo(Store::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    // Delete all from pivot table, set it's status to deleted
    // And then soft deletes himself. This is done so user can
    // delete order, but store owner will still see order
    public function fullDelete()
    {
        $this->products()->detach();
        $this->status_id = 7;
        $this->save();
        $this->delete();
    }

    // Can buyer edit orders
    public function canEdit()
    {
        if ($this->status->name !== 'recieved' && $this->status->name !== 'paused') {
            return false;
        } else {
            return true;
        }
    }

    // Used for creating random slug for order
    // Doesn't contain o, O, 0 because of readibility
    public function getGenerateSlugAttribute()
    {
        $string = '';
        for ($i = 1, $j = -1; $i < 9; $i++) {
            if ($i % 3 === 0 || $i % 3 === 1) {
                $char = chr(rand(65,90));
                $string .= ($char === 'O') ? 'A' : $char;
            } else {
                $char = intval(substr(time(), $j, 1));
                $string .= ($char === 0) ? rand(1, 9) : $char;
                $j--;
            }
        }
        // Checks if this slug exists in database
        $notUnique = $this->where('slug', $string)->first();
        if($notUnique) {
            $string = $this->getGenerateSlugAttribute();
        }
        return $string;
    }

}
