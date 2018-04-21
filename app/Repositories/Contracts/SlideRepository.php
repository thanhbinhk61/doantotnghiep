<?php

namespace App\Repositories\Contracts;

interface SlideRepository extends AbstractRepository
{
	public function getHome($limit, $columns = ['*']);

	public function getCategory($limit, $columns = ['*']);

	public function datatables($columns = ['*']);
}
