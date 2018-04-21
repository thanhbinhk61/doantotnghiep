<?php

namespace App\Repositories;

use App\Eloquent\Menu;
use App\Repositories\Contracts\MenuRepository;

class MenuRepositoryEloquent extends AbstractRepositoryEloquent implements MenuRepository
{
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }

    public function root($section, $columns = ['*'])
    {
        return $this->model->with(['children','page','category','children.page','children.category','children.children','children.children.page','children.children.category'])
        ->where('parent_id',0)
        ->where('section',$section)
        ->orderBy('order')->get($columns);
    }
}
