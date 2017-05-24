<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Cart;
use App\Status;

class Order extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['buyer_id', 'store_id', 'status_id', 'address_id'];
    protected $dates = ['deleted_at'];


    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot(['amount', 'product_price'])->withTimestamps();
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

    public function address()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeDelivered($query)
    {
        $status = Status::where('name', 'delivered')->first();
        $query->where('status_id', $status->id);
    }

    public function refresh($fullRefresh = false)
    {
        $order = Order::find($this->id);
        if ($fullRefresh) {
            $order->updatePrice(true);
            $order->deleteIfEmpty();
        }
        return $order;
    }


    public function updatePrice($newProductPrice = false)
    {
        $price = 0;
        // Refresh its products
        // $products = Order::find($this->id)->products;
        $products = $this->refresh()->products;
        foreach ($products as $product) {
            if ($newProductPrice) {
                $price += $product->price * $product->pivot->amount;
            } else {
                $price += $product->pivot->product_price * $product->pivot->amount;
            }
        }
        $this->price = $price;
        $this->save();

        return $this->price;
    }

    public function deleteIfEmpty()
    {
        if ($this->products->count() === 0) $this->fullDelete();
    }




    public function fullDelete()
    {
        $this->products()->detach();
        $this->update(['status_id' => 6]);
        $this->delete();
    }




    public static function fullCreate(array $data, Buyer $buyer)
    {
        // dd(Cart::items($buyer->store)->first()->pivot->amount);
        $order = Order::create([
            'buyer_id' => $buyer->id,
            'store_id' => $buyer->store->id,
            'address_id' => $data['address_id']
        ]);

        foreach (Cart::items($buyer->store) as $product) {
            $order->editProduct($product, $product->pivot->amount);
            $order->save();
        }
        // dd($order->products);
        // dd(Order::find($order->id)->products);
        $order->updatePrice();

        Cart::removeAll($buyer->store);
    }






    public function fullUpdate(array $products)
    {
        $items = [];

        foreach ($products as $slug => $amount) {

            if (!is_numeric($amount) || $amount < 0) return false;

            $amount = intval($amount);
            if ($amount === 0) break;

            $product = $this->store->products()->where('slug', $slug)->first();
            if (!$product) return false;

            $items[] = compact('product', 'amount');
        }

        foreach ($items as $item) {
            $this->editProduct($item['product'], $item['amount']);
        }

        $this->refresh();

        return true;
    }




    public function editProduct(Product $product, int $amount, $replaceAmount = true)
    {
        $currentProduct = $this->products()->find($product->id);

        // Removes product from order if exists
        if ($currentProduct) {
            $this->products()->detach($currentProduct->id);
            $product->addRemaining($currentProduct->pivot->amount);
            if ($replaceAmount === false) $amount += $currentProduct->pivot->amount;
        }
        // If amount is 0 his job is done
        if ($amount === 0) return;

        $this->updatePrice();
        $this->save();
        $product->subtractRemaining($amount);

        $this->products()->attach($product->id, ['amount' => $amount, 'product_price' => $product->price]);
    }



    // Can buyer edit orders
    public function canEdit()
    {
        if ($this->status->name !== 'confirmed' && $this->status->name !== 'paused') {
            return false;
        } else {
            return true;
        }
    }



    public function togglePause()
    {
        if ($this->status->name === 'confirmed'){
            $this->update(['status_id' => 7]);
        } elseif ($this->status->name == 'paused') {
            $this->update(['status_id' => 1]);
        } else {
            return false;
        }
        $this->updatePrice(true);

        return true;
    }


    // Samo citljivi karakteri, da se ne mesa 0 i O, l i I.
    public function getGenerateSlugAttribute()
    {
        $faker = \Faker\Factory::create();
        $string = '';

        for ($i = 0; $i < 7; $i++) {
            $string .= $faker->randomElement(str_split('abcdefghjkmnpqrstuvwxyz23456789'));
        }

        $notUnique = $this->where('slug', $string)->first();

        return ($notUnique) ? $this->getGenerateSlugAttribute() : $string;
    }

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

}
