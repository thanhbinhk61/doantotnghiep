<?php

namespace App\Repositories\Contracts;

interface ExpenseRepository extends AbstractRepository
{
	public function isActive($columns = ['*']);
}
