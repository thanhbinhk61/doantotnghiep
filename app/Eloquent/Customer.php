<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Customer extends Abstracts\Authenticatable
{
    protected $fillable = [
    	'name','password','phone','email','address','gender','age','avatar','facebook_id','google_id','description','status','category_id','provider_id','amount'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->orderBy('id','DESC');
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('id','DESC');
    }

    public function findOrderByCode($code)
    {
        return $this->orders()->where('code',$code)->first();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
