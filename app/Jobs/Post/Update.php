<?php

namespace App\Jobs\Post;

use App\Jobs\Job;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Database\Eloquent\Model;

class Update extends Job
{
    protected $attributes;

    protected $entity;

    public function __construct(Model $entity, array $attributes)
    {
        $this->attributes = $attributes;
        $this->entity = $entity;
    }

    public function handle(PostRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            if (!empty($this->entity->image)) {
                $this->destroyImage($this->entity->image);
            }
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $this->attributes['user_id'] = \Auth::user()->id;
        $repository->update($this->entity, $this->attributes);
        if (isset($this->attributes['cate_id'])) {
            $this->entity->categories()->sync($this->attributes['cate_id']);
        }
    }
}
