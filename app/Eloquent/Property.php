<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'type', 'name', 'value','logo','status','category_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->where('status','<>',3);
    }

    public function brandProducts()
    {
    	return $this->hasMany(Product::class,'brand_id','id')->where('status',1)->where('status','<>',3)->with('getRating');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
