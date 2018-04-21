<?php

namespace App\Jobs\Contact;

use App\Jobs\Job;
use App\Repositories\Contracts\ContactRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(ContactRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
