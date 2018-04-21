<?php

namespace App\Repositories;

use App\Eloquent\Provider;
use App\Repositories\Contracts\ProviderRepository;

class ProviderRepositoryEloquent extends AbstractRepositoryEloquent implements ProviderRepository
{
    public function __construct(Provider $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }

    public function getActive($limit, $columns = ['*'])
    {
    	return $this->model->where('status',1)->take($limit)->get($columns);
    }
}
