<?php

namespace App\Eloquent;

class Category extends Abstracts\Sluggable
{
	protected $fillable = [
        'type', 'name', 'parent_id', 'intro','order','image','color','icon_fa','title','keywords','description','feature',
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function productBrand()
    {
        return $this->belongsToMany(Product::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->with('getRating')->where('status','<>','3');
    }

    public function productHome()
    {
        return $this->products()->where('status','1')->orderBy('id','DESC')->limit('8');
    }

    public function productNew()
    {
        return $this->productHome()->where('section',1);
    }

    public function productSpecial()
    {
        return $this->productHome()->where('sale',2);
    }

    public function productSame()
    {
        return $this->products()->with('getRating')->orderByRaw("RAND()")->take(8);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function postHome()
    {
        return $this->posts()->where('status','1')->orderBy('id','DESC')->limit('8');
    }

    public function postSame()
    {
        return $this->posts()->with('user')->orderByRaw("RAND()")->take(5);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class)->where('status',1);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class)->where('status',1);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function slides()
    {
        return $this->hasMany(Slide::class)->where('section',2);
    }
}
