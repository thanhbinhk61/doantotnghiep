<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PropertyRepository;

class BrandController extends Controller
{
    protected $repository;

    public function __construct(PropertyRepository $property)
    {
        $this->repository = $property;
    }

    public function index()
    {
    	$compacts['brands'] = $this->repository->getBrand(24);
        return view('frontend.brand.index',$compacts);
    }

    public function product($id)
    {
    	$compacts['brand'] = $this->repository->findOrFail($id);
    	$compacts['products'] = $compacts['brand']->brandProducts()->orderBy('id','DESC')->paginate(12);
    	return view('frontend.brand.product',$compacts);
    }
}
