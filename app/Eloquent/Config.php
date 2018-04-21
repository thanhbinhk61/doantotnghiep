<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
    'title','description','keywords','facebook','youtube','twitter','email','card_atm',
    'phone','address','timework','countdown','note','content','intro','logo','banner_login','icon','scripts','label'
    ];

    public $timestamps = false;
}
