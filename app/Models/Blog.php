<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function getImageAttribute($value)
    {
        return asset('front/assets/img/uploads/blogs/' . $value);
    } // end of get image attribute
    protected $appends = array('title_field','des_field','summary_field');
    protected $fillable = ['title','title_ar','des','des_ar','summary','summary_ar','image','published'];


    public function getTitleFieldAttribute()
{
    if(app()->getLocale()=='ar'){
        return $this->{'title_'.app()->getLocale()};
    }else{
        return $this->title;
    }

}
public function getDesFieldAttribute()
{
    if(app()->getLocale()=='ar'){
        return $this->{'des'.app()->getLocale()};
    }else{
        return $this->content;
    }

}
public function getSummaryFieldAttribute()
{
    if(app()->getLocale()=='ar'){
        return $this->{'summary_'.app()->getLocale()};
    }else{
        return $this->summary;
    }

}

}
