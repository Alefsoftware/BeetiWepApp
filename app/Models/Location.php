<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  public $table = "locations";
  protected $guarded = [
  ];
  public function customer(){
   return  $this->belongsTo('App\Models\User','user_id');
  }
}
