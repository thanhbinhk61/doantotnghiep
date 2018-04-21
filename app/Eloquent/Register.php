<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [
    	'name','phone','store_show','email','company_name','company_type',
    	'city','district','address','contact','number_register','brand','category_id','note','status'
    ];
}
