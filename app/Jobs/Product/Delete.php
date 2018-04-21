<?php

namespace App\Jobs\Product;

use App\Jobs\Job;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class Delete extends Job
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function handle(ProductRepository $repository)
    {
        if (!empty($this->entity->image)) {
            $this->destroyImage($this->entity->image);
        }
        $repository->delete($this->entity);
    }
}
