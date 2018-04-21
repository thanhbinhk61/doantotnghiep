<?php

namespace App\Repositories;

use App\Eloquent\Slide;
use App\Repositories\Contracts\SlideRepository;

class SlideRepositoryEloquent extends AbstractRepositoryEloquent implements SlideRepository
{
    public function __construct(Slide $model)
    {
        parent::__construct($model);
    }

    public function getHome($limit, $columns = ['*'])
    {
    	return $this->model->where('status','1')->where('section','1')->orderBy('id','DESC')->take($limit)->get($columns);
    }

    public function getCategory($limit, $columns = ['*'])
    {
    	return $this->model->where('status','1')->where('section','2')->orderBy('id','DESC')->take($limit)->get($columns);
    }

    public function datatables($columns = ['*'])
    {
        return $this->model->with('category')->get($columns);
    }
}
