<?php

namespace App\Jobs\Post;

use App\Jobs\Job;
use App\Repositories\Contracts\PostRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(PostRepository $repository)
    {
        $this->attributes['user_id'] = \Auth::user()->id;
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $item = $repository->create($this->attributes);
        if (isset($this->attributes['cate_id'])) {
            $item->categories()->sync($this->attributes['cate_id']);
        }
    }
}
