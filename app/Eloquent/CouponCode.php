<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $fillable = [
    	'code','coupon_id'
    ];

    public $timestamps = false;

    public function coupon()
    {
    	return $this->belongsTo(Coupon::class);
    }

    public function deleteByCode($code)
    {
        return self::where('code',$code)->delete();
    }

    public function getCouponByCode($code)
    {
        $code = self::where('code',$code)->first();
        return ($code) ? $code->coupon : null; 
    }

    public function generate()
    {
    	$exists = true;
        while ($exists) {
            $code = str_random(20);
            $check = self::where('code', $code)->first();
            if(!count($check)) {
                $exists = false;
            }
        }
        return $code;
    }
}
