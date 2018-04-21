<?php

namespace App\Repositories;

use App\Eloquent\Contact;
use App\Repositories\Contracts\ContactRepository;

class ContactRepositoryEloquent extends AbstractRepositoryEloquent implements ContactRepository
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

}
