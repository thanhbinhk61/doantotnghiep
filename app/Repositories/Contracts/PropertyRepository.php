<?php

namespace App\Repositories\Contracts;

interface PropertyRepository extends AbstractRepository
{
   public function type($type, $columns = ['*']);

   public function getBrand($paginate, $columns = ['*']);

   public function datatables($columns = ['*']);
}
