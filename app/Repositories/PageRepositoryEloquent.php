<?php

namespace App\Repositories;

use App\Eloquent\Page;
use App\Repositories\Contracts\PageRepository;

class PageRepositoryEloquent extends AbstractRepositoryEloquent implements PageRepository
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }
}
