<?php

namespace App\Eloquent;

class Page extends Abstracts\Sluggable
{
   protected $fillable = [
        'name','content','title','description','keywords','status','user_id',
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
