<?php

namespace App\Jobs\Slide;

use App\Jobs\Job;
use App\Repositories\Contracts\SlideRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(SlideRepository $repository)
    {
        if (!empty($this->entity->image)) {
            $this->destroyImage($this->entity->image);
        }
        $repository->delete($this->entity);
    }
}
