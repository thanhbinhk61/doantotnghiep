<?php

namespace App\Repositories\Contracts;

interface PostRepository extends AbstractRepository
{
	public function findBySlug($slug);

	public function getHome($limit, $columns = ['*']);
}
