<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code','name','email','phone','address','note','status','total','ship','card_id','expense_id','coupon_id','customer_id','address_id'
    ];

    public function products()
	{
		return $this->belongsToMany(Product::class)->withPivot('quantity','color','other','price','provider_id','discount');
	}

	public function expense()
	{
		return $this->belongsTo(Expense::class);
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function coupon()
	{
		return $this->belongsTo(Coupon::class);
	}

	public function addressCustomer()
	{
		return $this->belongsTo(Address::class,'address_id');
	}
}
