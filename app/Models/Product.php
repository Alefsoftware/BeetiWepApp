<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends BaseModel {
//    use LogsActivity;


    protected $guarded = [
    ];
    protected $hidden = [
    ];
    public $table = "products";

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }



	public function prices(){
   		return  $this->hasMany('App\Models\ProductPrice','product_id');
 	}

    public function provider() {
        return $this->belongsTo('App\Models\Provider', "provider_id");
    }

	public function category() {
        return $this->belongsTo('App\Models\Category', "category_id");
    }

	public function images() {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function review()
    {
         return $this->hasMany(ProductReview::class);

    }

      public function orderproducts() {
        return $this->hasMany(OrderProduct::class);
    }
    public function getTitleAttribute($value)
    {
        return $value;
    }

    // public function getMainImageAttribute()
    // {
    //     if (@$this->images) {
    //         return @$this->images[0]->image_name;
    //     }
    // }

    public function getMainImageAttribute($value)
    {
        // if($value != null){
        // return asset('/storage/product_images/' . $value);
        // }else{
            // return @$this->images[0]->image_name;
            //  return asset(@$this->images[0]->image_name);
            return  @$this->images[0]->image_name;
            //  return asset( @$this->images[0]->image_name);
        // }
    } // end of get image attribute


    public function getAvgRateAttribute()
    {

        if ($this) {
            if($this->review()->count() > 0){
                return round( ((float) $this->review()->sum('rate') / $this->review()->count()) ,2);
            }else{
                return 0;
            }
        }
    }

    public function getMinPriceAttribute()
    {

        if ($this) {
            if($this->prices()->count() > 0){
                return  ( $this->prices()->min('price'));
            }else{
                return 0;
            }
        }



    }


    protected $appends = array('count_users_review'/*,'total_num_of_reviews'*/);


    public function getCountUsersReviewAttribute()
    {
        return  $this->review()->distinct('customer_id')->where('product_id',$this->id)->count();
    }
//    public function getTotalNumOfReviewsAttribute()
//    {
//        return  $this->review()->where('product_id',$this->id)->count();
//    }

    public static function boot() {
        parent::boot();

        static::deleting(function($product) {
             $product->review()->delete();
             $product->images()->delete();
             $product->prices()->delete();


        });
    }

}
