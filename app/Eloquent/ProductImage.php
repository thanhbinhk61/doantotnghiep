<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
    	'name','image','product_id','type'
    ];

    //protected $table = 'product_images';

    public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
