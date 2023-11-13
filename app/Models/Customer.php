<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Request;

class Customer extends Authenticatable
{

    protected $guarded = [
        'reset_token',
        'confirm_token',
        'token',
        'password_confirmation',
    ];
    public $table = "customers";
    protected $hidden = ['password', 'remember_token',
        'admin_id', 'reset_token', 'confirm_token', 'token', 'updated_at'];

    // protected $appends = array('country');
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    //public function getProfileImg(){
    //	return url('public')."storage/profile_images/".$this->profile_img;
    //}
    public function getProfileImgAttribute($value)
    {
        if ($value != null && $this->social_type != null) {
            return $value;
        }
        elseif ($value != null) {
            return env('APP_URL') . "/storage/profile_images/" . $value;
        }


    }

    public function address() {
        return $this->hasMany('App\Models\Address',"client_id");
    }
    public function orders() {
        return $this->hasMany('App\Models\Order',"client_id");
    }

//    public function getCountryIdAttribute($value)
//    {
//
//        if ($value == null) {
//            $countryObject = \App\Models\Countries::where("phonecode", $this->country_code)->first();
//            $this->country_id = $countryObject['id'];
//            $this->save();
//            //return $value = $countryObject['id'];
//        }
//        if ($value!=null)
//        {
//            return $value;
//        }
//
//
//    }


}
