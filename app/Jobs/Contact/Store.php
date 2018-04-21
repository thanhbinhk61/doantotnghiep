<?php

namespace App\Jobs\Contact;

use App\Jobs\Job;
use App\Repositories\Contracts\ContactRepository;

class Store extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(ContactRepository $repository)
    {
        $repository->create($this->attributes);
    }
}
