<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Buyer;

class CartItem extends Model
{
    protected $table = 'cart';
    
    public function buyer()
    {  
       return $this->belongsTo(Buyer::class); 
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    } 

}
