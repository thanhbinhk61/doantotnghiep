<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'name','phone','address','expense_id','description','customer_id'
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function expense()
    {
    	return $this->belongsTo(Expense::class);
    }
}
