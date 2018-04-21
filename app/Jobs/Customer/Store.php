<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Repositories\Contracts\CustomerRepository;
use File;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(CustomerRepository $repository)
    {
        if (isset($this->attributes['avatar2']) && !filter_var($this->attributes['avatar2'], FILTER_VALIDATE_URL) === false) {
            $path = strtolower(class_basename($repository->getModel()));
            $image = file_get_contents($this->attributes['avatar2']);
            //dd($this->attributes['avatar2']);
            //dd($image);
            $this->attributes['avatar2'] = $this->setImageFromFile($image,$path);
        } else {
            unset($this->attributes['avatar2']);
        }
        if (isset($this->attributes['password'])) {
            $this->attributes['password'] = bcrypt($this->attributes['password']);
        }
        if (isset($this->attributes['category_id'])) {
            unset($this->attributes['category_id']);
        }
        if (isset($this->attributes['amount'])) {
            unset($this->attributes['amount']);
        }
        return $repository->create($this->attributes);
    }
}
