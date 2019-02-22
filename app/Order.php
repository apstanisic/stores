<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Core\Cart\Cart;

class Order extends Model
{
    use Sluggable;

    protected $fillable = ['buyer_id', 'store_id', 'status_id', 'address_id'];

    public function getRouteKeyName()
    {
        return 'slug';
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

    /**
     * Order has many products with different amounts
     *
     * @return Builder
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('amount', 'product_price')
                    ->withTimestamps();
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
        return $this->belongsTo(Address::class);
    }

    // /**
    //  * Filter by delivered orders. 
    //  * Allows for Orders::delivered()::where()...
    //  *
    //  * @param mixed $query - Laravel provides $query
    //  * @return void
    //  */
    // public function scopeDelivered($query)
    // {
    //     $status = Status::where('name', 'delivered')->first();
    //     $query->where('status_id', $status->id);
    // }


    /**
     * TODO: figure out do you need refresh
     *
     * @param boolean $fullRefresh
     * @return void
     */
    public function refresh($fullRefresh = false)
    {
        $order = Order::find($this->id);
        if ($fullRefresh) {
            $order->updatePrice(true);
            $order->deleteIfEmpty();
        }
        return $order;
    }


    /**
     * Update order price, when changing products amount
     *
     * @param boolean $currentProductPrice - should method use new product
     * prices if they are changed or they should stick with ones that 
     * were used when product was bought
     * @return integer
     */
    public function updatePrice($currentProductPrice = false)
    {
        $price = 0;
        // Refresh its products so it can get new prices??
        // $products = Order::find($this->id)->products;
        // $products = $this->refresh()->products;
        $products = $this->products;

        foreach ($products as $product) {
            if ($currentProductPrice) {
                $productPrice = $product->price;
            } else {
                $productPrice = $product->pivot->product_price;
            }
            $price += $productPrice * $product->pivot->amount;
        }

        $this->price = $price;
        $this->save();

        return $this->price;
    }



    /**
     * Create new order, add right products, and empty cart
     *
     * @param integer $addressId - addressId of the address that should be used
     * @param App\Buyer $buyer
     * @return void
     */
    public static function fullCreate(int $addressId, Buyer $buyer)
    {
        // Create empty order
        $order = Order::create([
            'buyer_id' => $buyer->id,
            'store_id' => $buyer->store->id,
            'address_id' => $addressId
        ]);

        // Add products to the order
        foreach (Cart::items($buyer->store) as $product) {
            $order->changeContent($product, $product->pivot->amount);
            $order->save();
        }

        // Update order price from 0
        $order->updatePrice();

        // Empty cart
        Cart::removeAll($buyer->store);
    }



    /**
     * Remove product from
     *
     * @param App\Product $product
     * @return void
     */
    public function removeProduct(Product $product)
    {
        $this->product()->detach($product->id);
        $this->updatePrice();
    }
    


    /**
     * Update order with changed product, changed amount, or both
     *
     * @param array $products - format is slug => amount
     * @return void
     */
    public function fullUpdate(array $products)
    {
        $items = [];
        foreach ($products as $slug => $amount) {
            
            $amount = intval($amount);
            
            // if amount is not integer or is negative skip current iteration
            if (!is_int($amount) || $amount < 0) {
                continue;
            }   

            // Skip current iteration if product is not valid
            $product = $this->store->products()->where('slug', $slug)->first();
            
            if (!$product) {
                continue;
            }
            // Amount is 0, remove product from order
            if ($amount === 0) {
                $this->removeProduct($product->id);                
            }
            $items[] = compact('product', 'amount');
        }

        // Add products to the order, and changes price
        foreach ($items as $item) {
            $this->changeContent($item['product'], $item['amount']);
        }

    }


    /**
     * Change content of order,
     *
     * @param AppProduct $product - product to add, update or delete
     * @param integer $amount - set amount, if amount is 0, it will delete product from order
     * @return void
     */
    public function changeContent(Product $product, int $amount)
    {
        $currentProduct = $this->products()->find($product->id);
        // Deleting old product if exists
        // If product exist in order
        if ($currentProduct) {
            // Remove product from order
            $this->products()->detach($currentProduct->id);
            // Return current product amount in cart to availible products
            $product->changeRemaining($currentProduct->pivot->amount);
        }
        // End deleting old product

        // If amount is 0 it will just remove product from order
        if ($amount === 0) return;

        // Update order price when deleting product from order
        $this->updatePrice();
        $this->save();

        // Get requested or maximum available product amount
        $amount = $product->requestedOrMax($amount);
        // Add product to order
        $this->products()->attach($product->id, [
            'amount' => $amount, 
            'product_price' => $product->price
        ]);

        // Update order price
        $this->updatePrice();
        // Change remaining available products
        $product->changeRemaining(-$amount);
    }



    /**
     * Should buyer be able to edit order
     *
     * @return boolean
     */
    public function buyerCanEdit()
    {
        if ($this->status->name === 'processing' || $this->status->name === 'paused') {
            return true;
        }

        return false;
    }



    /**
     * Set order on hold, it can be done if order is not put on processing, or sent
     *
     * @return void
     */
    public function togglePause()
    {
        switch ($this->status->name) {

            case 'processing':
                $status = Status::where('name', 'paused')->first();
                $this->update(['status_id' => $status->id]);
                break;

            case 'paused':
                $status = Status::where('name', 'processing')->first();
                $this->update(['status_id' => $status->id]);
                break;

            default:
                // Return false if order status can't be toggled
                return false;

        }

        $this->updatePrice(true);
        // Return true if order pause is toggled
        return true;
    }


    /**
     * Generate order slug(unique char combination)
     * If generated slug exists it will try to create it recursivly
     * It only uses easy to read chars, without 0, O, l, 1, I
     *
     * @return string
     */
    public function getGenerateSlugAttribute()
    {
        $chars = str_split('ABCDEFGHJKMNPQSTUVWXYZ23456789');
        $slug = implode('', array_random($chars, 15));
        
        $notUnique = $this->where('slug', $slug)->first();

        return ($notUnique) ? $this->getGenerateSlugAttribute() : $slug;
    }

}
