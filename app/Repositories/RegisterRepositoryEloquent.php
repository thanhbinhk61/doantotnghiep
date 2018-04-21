<?php

namespace App\Repositories;

use App\Eloquent\Register;
use App\Repositories\Contracts\RegisterRepository;

class RegisterRepositoryEloquent extends AbstractRepositoryEloquent implements RegisterRepository
{
    public function __construct(Register $model)
    {
        parent::__construct($model);
    }

    public function datatables($columns = ['*'])
    {
        return $this->model->get($columns);
    }

}
