<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'name','image','status','section','category_id','link',
    ];

    public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
