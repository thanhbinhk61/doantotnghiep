<?php

namespace App\Repositories;

use App\Eloquent\Property;
use App\Repositories\Contracts\PropertyRepository;

class PropertyRepositoryEloquent extends AbstractRepositoryEloquent implements PropertyRepository
{
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    public function type($type, $columns = ['*'])
    {
    	return $this->model->where('type',$type)->where('status',1)->get($columns);
    }

    public function getBrand($paginate, $columns = ['*'])
    {
    	return $this->model->where('type','brand')->where('status',1)->orderBy('id','DESC')->paginate($paginate, $columns);
    }

    public function datatables($columns = ['*'])
    {
        return $this->model->with(['category'])->select($columns);
    }

}
