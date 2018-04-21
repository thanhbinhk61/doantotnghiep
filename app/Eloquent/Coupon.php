<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
    	'name','type','value','min','status','expired_at'
    ];

    public function codes()
    {
    	return $this->hasMany(CouponCode::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
