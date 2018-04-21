<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = [
    	'info','name','email','address','note','reply','total','customer_id','status'
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
