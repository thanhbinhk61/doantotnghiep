<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
    	'name','bank','number','address','customer_id',
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
