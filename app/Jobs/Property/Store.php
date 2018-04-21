<?php

namespace App\Jobs\Property;

use App\Jobs\Job;
use App\Repositories\Contracts\PropertyRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(PropertyRepository $repository)
    {
    	if (isset($this->attributes['logo'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['logo'] = $this->setImage($this->attributes['logo'],$path);
        }
        $repository->create($this->attributes);
    }
}
