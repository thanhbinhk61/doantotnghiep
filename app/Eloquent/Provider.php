<?php

namespace App\Eloquent;

class Provider extends Abstracts\Sluggable
{
    protected $fillable = [
    	'name','slug','email','phone','image','logo','intro','status'
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function productBrand()
    {
        return $this->hasMany(Product::class)->where('status','<>',3);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->with('getRating')->where('status','<>',3);
    }

    public function getProduct()
    {
        return $this->products()->with('getRating')->orderBy('id','DESC')->limit('8');
    }
}
