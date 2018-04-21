<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProviderRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\ProductRepository;

class ProviderController extends Controller
{
	protected $repository;

	protected $productRepository;

    public function __construct(ProviderRepository $provider)
    {
        $this->repository = $provider;
    }

    public function index()
    {
        $compacts['providers'] = $this->repository->paginate(24);
        return view('frontend.provider.index',$compacts);
    }

    public function getProduct($slug, $range = null, $colors = null, $brands = null)
    {
    	$compacts['providers'] = $this->repository->getActive(10);
    	$compacts['provider'] = $this->repository->findBySlug($slug);
    	$compacts['colors'] = app(PropertyRepository::class)->type('color');
        $compacts['brands'] = app(PropertyRepository::class)->type('brand');
        if($range) {
            $compacts['rangePrice'] = ($range) ? explode('_', $range) : [150,750];
            $compacts['colorFilter'] = ($colors && $colors != 0) ? explode('_', $colors) : null;
            $compacts['brandFilter'] = ($brands && $brands != 0) ? explode('_', $brands) : null;
            $products = app(ProductRepository::class)->providerFilter($compacts['provider']->id,$compacts['rangePrice'], $compacts['colorFilter'], $compacts['brandFilter']);
        }

        else {
            $products = $compacts['provider']->products()->orderBy('id','DESC')->paginate(12);
        }
        $compacts['productProvider'] = $products;
    	return view('frontend.provider.product',$compacts);
    }
}
