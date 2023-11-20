<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin;
use App\Libs\Misc;
use Request;

class Subscriber extends BaseModel {

    protected $guarded = [
    ];
    protected $hidden = [
    ];
}