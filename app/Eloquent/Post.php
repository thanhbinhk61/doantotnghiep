<?php

namespace App\Eloquent;

class Post extends Abstracts\Sluggable
{
    protected $fillable = [
        'name','description','image','intro','content','tags','title','keywords','status','user_id',
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoryRoot()
    {
        return $this->categories()->where('parent_id','0')->take(1);
    }

    public function categoryChildren()
    {
        return $this->categories()->where('parent_id','>','0')->take(1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}