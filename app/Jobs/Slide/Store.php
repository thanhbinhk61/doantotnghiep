<?php

namespace App\Jobs\Slide;

use App\Jobs\Job;
use App\Repositories\Contracts\SlideRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(SlideRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $repository->create($this->attributes);
    }

}
