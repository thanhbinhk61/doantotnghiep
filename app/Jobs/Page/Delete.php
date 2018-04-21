<?php

namespace App\Jobs\Page;

use App\Jobs\Job;
use App\Repositories\Contracts\PageRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(PageRepository $repository)
    {
        $repository->delete($this->entity);
    }
}
