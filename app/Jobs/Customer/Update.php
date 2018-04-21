<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Repositories\Contracts\CustomerRepository;
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

    public function handle(CustomerRepository $repository)
    {
        if (isset($this->attributes['password'])) {
            $this->attributes['password'] = bcrypt($this->attributes['password']);
        }
        $repository->update($this->entity, $this->attributes);
    }
}
