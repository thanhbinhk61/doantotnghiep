<?php

namespace App\Repositories;

use App\Eloquent\Comment;
use App\Repositories\Contracts\CommentRepository;

class CommentRepositoryEloquent extends AbstractRepositoryEloquent implements CommentRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
