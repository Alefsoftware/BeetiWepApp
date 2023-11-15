<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;

class Cart extends BaseModel {

    protected $guarded = [
    ];
    protected $hidden = [];

    public $table = "cart";

	public function productPrice() {
        return $this->belongsTo('App\Models\ProductPrice', "price_id");
    }
    public function product() {
        return $this->belongsTo('App\Models\Product', "product_id");
    }

    public function getSumCartAttribute(){
        $cartItems = $this->where('client_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->with(['product', 'productPrice'])
            ->get();
            $sum = 0;
            $cartCount=0;
            foreach ($cartItems as $cartItem) {
                $sum += $cartItem->productPrice->price * $cartItem->count;
                $cartCount+=$cartItem->count;
            }
            return ['sum'=>$sum,
                    'count'=>$cartCount,
            ];
    }

}
