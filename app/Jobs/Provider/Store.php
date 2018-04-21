<?php

namespace App\Jobs\Provider;

use App\Jobs\Job;
use App\Repositories\Contracts\ProviderRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(ProviderRepository $repository)
    {
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        if (isset($this->attributes['logo'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['logo'] = $this->setImage($this->attributes['logo'],$path);
        }
        $repository->create($this->attributes);
    }
}