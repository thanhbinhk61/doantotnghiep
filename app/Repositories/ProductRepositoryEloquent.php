<?php

namespace App\Repositories;

use App\Eloquent\Product;
use App\Repositories\Contracts\ProductRepository;

class ProductRepositoryEloquent extends AbstractRepositoryEloquent implements ProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }

    public function random($limt, $columns = ['*'])
    {
    	return $this->model->where('status','<>',3)->with('getRating')->orderByRaw("RAND()")->take($limt)->get($columns);
    }

    public function onSale($limt, $columns = ['*'])
    {
        return $this->model->with('getRating')->where('status','<>',3)->where('sale',2)->orderByRaw("RAND()")->take($limt)->get($columns);
    }

    public function search($value, $paginate = 12, $columns = ['*'])
    {
        return $this->model->with('getRating')->where('status','<>',3)
        ->where('name','LIKE','%'.$value.'%')
        ->orWhere('code','LIKE','%'.$value.'%')
        ->orWhere('intro','LIKE','%'.$value.'%')
        ->orWhere('tags','LIKE','%'.$value.'%')
        ->orWhere('price','LIKE','%'.$value.'%')
        ->orderBy('id','DESC')->paginate($paginate, $columns);
    }

    public function ajaxSearch($value, $columns = ['*'])
    {
        return $this->model->where('status','<>',3)
        ->where('name','LIKE','%'.$value.'%')
        ->orWhere('code','LIKE','%'.$value.'%')
        ->orWhere('intro','LIKE','%'.$value.'%')
        ->orWhere('tags','LIKE','%'.$value.'%')
        ->orWhere('price','LIKE','%'.$value.'%')
        ->orderBy('id','DESC')->take(10)->get($columns);
    }

    public function categoryFilter($idcategory,array $range, $colors = null, $brands = null, $columns = ['*'])
    {
        if ($range && $colors && $brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->whereHas('categories', function ($query) use ($idcategory) {
                        $query->where('id',$idcategory); })
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereHas('properties',function ($query) use ($colors){
                        $query->whereIn('id',$colors);})
                    ->whereIn('brand_id',$brands)
                    ->paginate(12,['products.*']);
        }

        elseif ($range && $colors && !$brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->whereHas('categories', function ($query) use ($idcategory) {
                        $query->where('id',$idcategory); })
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereHas('properties',function ($query) use ($colors){
                        $query->whereIn('id',$colors);})
                    ->paginate(12,['products.*']);
        }

        elseif ($range && !$colors && $brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->whereHas('categories', function ($query) use ($idcategory) {
                        $query->where('id',$idcategory); })
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereIn('brand_id',$brands)
                    ->paginate(12,['products.*']);
        }

        else {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->whereHas('categories', function ($query) use ($idcategory) {
                        $query->where('id',$idcategory); })
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->paginate(12,['products.*']);
        }
    }

    public function providerFilter($idprovider, array $range, $colors = null, $brands = null, $columns = ['*'])
    {
        if ($range && $colors && $brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->where('provider_id',$idprovider)
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereHas('properties',function ($query) use ($colors){
                        $query->whereIn('id',$colors);})
                    ->whereIn('brand_id',$brands)
                    ->paginate(12,['products.*']);
        }

        elseif ($range && $colors && !$brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->where('provider_id',$idprovider)
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereHas('properties',function ($query) use ($colors){
                        $query->whereIn('id',$colors);})
                    ->paginate(12,['products.*']);
        }

        elseif ($range && !$colors && $brands) {
            return $this->model->with('getRating')->where('status','<>',3)
                    ->where('provider_id',$idprovider)
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->whereIn('brand_id',$brands)
                    ->paginate(12,['products.*']);
        }

        else {
            return $this->model->with('getRating')
                    ->where('provider_id',$idprovider)->where('status','<>',3)
                    ->where(function($query) use ($range) {
                        $query->whereBetween('price',[$range[0] . '000',$range[1] . '000']); })
                    ->paginate(12,['products.*']);
        }
    }

    public function byOrderProvider($providerId)
    {
        return $this->model->whereHas('orders', function ($query) use ($providerId) {
            $query->where('orders.status',88)
            ->where('provider_id', '<>', null)
            ->where('provider_id', $providerId);
        })->get();
    }
}
