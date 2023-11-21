<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;

class Config extends BaseModel {

    protected $guarded = [
    ];
    protected $append=['value_field'];

    public function getValueFieldAttribute(){
        if(app()->getLocale('ar')){
            return $this->value_ar;
        }else{
            return $this->value;
        }
    }
}
