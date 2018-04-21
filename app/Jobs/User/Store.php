<?php

namespace App\Jobs\User;

use App\Jobs\Job;
use App\Repositories\Contracts\UserRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(UserRepository $repository)
    {
        $this->attributes['password'] = bcrypt($this->attributes['password']);
        if (isset($this->attributes['image'])) {
            $path = strtolower(class_basename($repository->getModel()));
            $this->attributes['image'] = $this->setImage($this->attributes['image'],$path);
        }
        $user = $repository->create($this->attributes);
        if (isset($this->attributes['role_id'])) {
            $user->roles()->sync($this->attributes['role_id']);
        }
    }
}
