<?php

namespace App\Repositories;

use App\Eloquent\Post;
use App\Repositories\Contracts\PostRepository;

class PostRepositoryEloquent extends AbstractRepositoryEloquent implements PostRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }

    public function getHome($limit, $columns = ['*'])
    {
    	return $this->model->where('status','1')->with('categories')->orderBy('id','DESC')->take($limit)->get($columns);
    }
}
