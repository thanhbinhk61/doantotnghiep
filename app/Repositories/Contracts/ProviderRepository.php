<?php

namespace App\Repositories\Contracts;

interface ProviderRepository extends AbstractRepository
{
	public function findBySlug($slug);

	public function getActive($limit, $columns = ['*']);
}
