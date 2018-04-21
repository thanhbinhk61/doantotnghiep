<?php

namespace App\Repositories;

use App\Eloquent\Expense;
use App\Repositories\Contracts\ExpenseRepository;

class ExpenseRepositoryEloquent extends AbstractRepositoryEloquent implements ExpenseRepository
{
    public function __construct(Expense $model)
    {
        parent::__construct($model);
    }
    
    public function isActive($columns = ['*'])
    {
    	return $this->model->where('status',1)->where('type','ship')->orderBy('name')->get($columns);
    }
}
