<?php

namespace App\Repositories\Contracts;

interface ProductRepository extends AbstractRepository
{
	public function findBySlug($slug);

	public function random($limt, $columns =  ['*']);

	public function onSale($limt, $columns = ['*']);

	public function ajaxSearch($value, $columns = ['*']);

	public function search($value, $paginage = 10, $columns = ['*']);

	public function categoryFilter($idcategory,array $range, $colors = null, $brands = null, $columns = ['*']);

	public function providerFilter($idprovider, array $range, $colors = null, $brands = null, $columns = ['*']);

	public function byOrderProvider($providerId);
}
