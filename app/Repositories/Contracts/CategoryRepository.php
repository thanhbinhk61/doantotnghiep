<?php

namespace App\Repositories\Contracts;

interface CategoryRepository extends AbstractRepository
{
   public function posts($columns = ['*']);

   public function products($columns = ['*']);

   public function properties($columns = ['*']);
   
   public function customers($columns = ['*']);

   public function type($type, $columns = ['*']);

   public function rootWithType($type, $columns = ['*']);

   public function productHome($limit, $columns = ['*']);

   public function postHome($limit, $columns = ['*']);

   public function postHomeFeature($limit, $columns = ['*']);

   public function findBySlug($slug);
}
