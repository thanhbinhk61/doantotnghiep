<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name','parent_id','type','type_id','order','section','link','image'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function page()
    {
    	return $this->belongsTo(Page::class, 'type_id');
    }

    public function category()
    {
    	return $this->belongsTo(Category::class, 'type_id');
    }
}
