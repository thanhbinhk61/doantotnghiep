<?php

namespace App\Repositories;

use App\Eloquent\Ship;
use App\Repositories\Contracts\ShipRepository;

class ShipRepositoryEloquent extends AbstractRepositoryEloquent implements ShipRepository
{
    public function __construct(Ship $model)
    {
        parent::__construct($model);
    }

    public function datatables($columns = ['*'])
    {
        return $this->model->with('customer')->get($columns);
    }

}
