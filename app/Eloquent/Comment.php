<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'name','email','phone','image','product_id','vote','content','status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
