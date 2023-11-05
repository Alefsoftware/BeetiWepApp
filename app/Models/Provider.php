<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Request;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Provider extends Authenticatable {
//    use LogsActivity;
    protected $guarded = [
        'reset_token',
        'confirm_token',
        'token',
        'password_confirmation',
    ];
    public $table = "providers";
    protected $hidden = ['password', 'remember_token', 'published',
        'admin_id', 'reset_token', 'confirm_token',  'updated_at','confirmed','merchant_mail','secret_key','token','pivot',"profile_img"];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }




//	public function getProfileImg(){
//		return url('public')."storage/profile_images/".$this->profile_img;
//	}
     public function getProfileImgAttribute($value) {
        if ($value != null) {
            return 	asset("/storage/profile_images/".$value) ?:  asset('default_user.png');
        }else{
            return @$this->images[0]->image_name ?: asset('default_user.png') ;
        }
	 }

	public function images() {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function paymentMethods() {
        return $this->BelongsToMany('App\Models\PaymentMethod', 'provider_payment_methods', 'provider_id', 'payment_id');
    }

    public function categories() {
        return $this->BelongsToMany('App\Models\Category', 'provider_categories', 'provider_id', 'category_id');
    }
    public function statusObj()
    {
         return $this->belongsTo(ProviderStatus::class,'status');

    }
    public function reviews()
    {
        return $this->hasMany(ProviderReview::class);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product',"provider_id");
    }

    public function country()
    {
        return $this->belongsTo("\App\Models\Countries","country");
    }

    public function countryObj()
    {
        return $this->belongsTo("\App\Models\Countries","country");
    }
    public function zoneObj()
    {
        return $this->belongsTo("\App\Models\Zones","zone");
    }
    public function govObj()
    {
        return $this->belongsTo("\App\Models\Gov","gov");
    }

    public function promos()
    {
        return $this->hasMany("App\Models\PromoCode","provider_id");
    }

    public function drivers() {
        return $this->belongsToMany(Driver::class,'provider_driver');
    }
    // public function getStatusAttribute($value) {
    //     $statusObj = \App\Models\ProviderStatus::find($value);
	// 	return 	$statusObj->title;
	// }

    protected $appends = array('rate');

    public function getRateAttribute()
    {
        $rows = ProductReview::with('customer')
            ->whereHas('product', function ($q) {
                $q->where('provider_id', '=', $this->id);
            })
            ->get();
        //dd($this->id);
    //   dd($rows->avg('rate'));
//        $value = (float)$rows->avg('rate');

        if ($this) {
//            dd($rows->count());
            if ($rows->count() > 0) {
                return round(((float)$rows->sum('rate') / $rows->count()), 2);
            } else {
                return 0;
            }
        }
    }


// public function  getCountryAttribute($value)
// {
//     $countryObj = \App\Models\Countries::find($value);
//      	return 	$countryObj->name_ar;
// }
    // public function  getGovAttribute($value)
    // {
    //     $countryObj = \App\Models\Gov::find($value);
    //     return 	$countryObj->title;
    // }

    // public function  getZoneAttribute($value)
    // {
    //     $countryObj = \App\Models\Zones::find($value);
    //     return 	$countryObj->name_ar;
    // }

    public static function boot() {
        parent::boot();

        static::deleting(function($provider) {
             $provider->categories()->delete();
            //  $provider->setPasswordAttribute()->delete();
            //  $provider->getProfileImg()->delete();
             $provider->images()->delete();
             $provider->paymentMethods()->delete();

        });
    }

}
