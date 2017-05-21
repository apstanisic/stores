<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Order extends Model
{
    use SoftDeletes;
    use Sluggable;


    protected $fillable = ['status_id']
    protected $dates = ['deleted_at'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'generateSlug',
                'unique' => true,
                'onUpdate' => false,
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    public static function fullCreate(Buyer $buyer)
    {
        $order = Order::create([
            'buyer_id' => $buyer->id,
            'store_id' => $buyer->store->id,
            'price' => Cart::price($buyer->store)
        ]);

        foreach (Cart::items($buyer->store) as $product) {
            $order->products()->attach($product->id, ['amount' => $product->pivot->amount]);
        }

        Cart::emptyCart($store);
    }

    public function fullUpdate(array $products)
    {
        $this->price = 0;
        $items = [];

        foreach ($products as $slug => $amount) {

            if (!is_numeric($amount)) return false;

            $amount = intval($amount);
            if ($amount < 0 || $amount > 1000) {
                return false;
            } elseif ($amount === 0) {
                break;
            }

            $product = $this->store->products()->where('slug', $slug)->first();
            if (!$product) return false;

            $items[] = compact('product', 'amount');
        }

        $this->products()->detach();

        foreach ($items as $item) {
            $this->products()->attach($item['product']->id, ['amount' => $item['amount']]);
            $this->price += $item['product']->price * $item['amount'];
        }

        if (!count($items)) {
            $this->delete();
        } else {
            $this->save();
        }

        return true;
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

    public function togglePause()
    {
        if ($this->status->name === 'recieved'){
            $this->update(['status_id' => 6]);
        } elseif ($this->status->name == 'paused') {
            $this->update(['status_id' => 1]);
        } else {
            return false;
        }

        return true;
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
