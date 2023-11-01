<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;

class ProductPrice extends BaseModel {

    protected $append = [
        'min_price'
    ];
    protected $guarded = [
    ];
    protected $hidden = [
    ];
    public $table = "products_prices";

    public function unit() {
        return $this->belongsTo('App\Models\Unit', "unit_id");
    }



    public function product() {
        return $this->belongsTo('App\Models\Product', "product_id");
    }
}
