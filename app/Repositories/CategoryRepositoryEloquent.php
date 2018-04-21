<?php

namespace App\Repositories;

use App\Eloquent\Category;
use App\Repositories\Contracts\CategoryRepository;

class CategoryRepositoryEloquent extends AbstractRepositoryEloquent implements CategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function posts($columns = ['*'])
    {
        return $this->model->where('type','post')->get($columns);
    }

    public function products($columns = ['*'])
    {
    	return $this->model->where('type','product')->get($columns);
    }

    public function properties($columns = ['*'])
    {
        return $this->model->where('type','property')->get($columns);
    }

    public function customers($columns = ['*'])
    {
        return $this->model->where('type','customer')->get($columns);
    }

    public function type($type, $columns = ['*'])
    {
    	return $this->model->where('type',$type)->with('children')->get($columns);
    }

    public function rootWithType($type, $columns = ['*'])
    {
        return $this->model->where('type', $type)->where('parent_id',0)->with('children')->get($columns);
    }

    public function productHome($limit, $columns = ['*'])
    {
        return $this->model->where('type','product')->where('order','>',0)->orderBy('order')->take($limit)->get($columns);
    }

    public function postHome($limit, $columns = ['*'])
    {
        return $this->model->where('type','post')->where('order','>',0)->orderBy('order')->take($limit)->get($columns);
    }

    public function postHomeFeature($limit, $columns = ['*'])
    {
        return $this->model->where('type','post')->where('order','>',0)->where('feature',2)->orderBy('order')->with(['postHome','postHome.categories'])->take($limit)->get($columns);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }
}
