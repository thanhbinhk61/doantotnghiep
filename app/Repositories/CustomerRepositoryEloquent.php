<?php

namespace App\Repositories;

use App\Eloquent\Customer;
use App\Repositories\Contracts\CustomerRepository;

class CustomerRepositoryEloquent extends AbstractRepositoryEloquent implements CustomerRepository
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function findCustomerFacebook($customerID)
    {
    	return $this->model->where('facebook_id',$customerID)->first();
    }

    public function findCustomerGoogle($customerID)
    {
    	return $this->model->where('google_id',$customerID)->first();
    }

    public function datatables($column = ['*'])
    {
        return $this->model->with('orders')->where('provider_id',0)->get($column);
    }

    public function providers($column = ['*'])
    {
        return $this->model->with(['provider'])->where('provider_id', '>',0)->get($column);
    }

}
