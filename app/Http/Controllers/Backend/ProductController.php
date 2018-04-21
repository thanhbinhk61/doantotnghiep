<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\ProductRequest;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\ProviderRepository;
use App\Services\Contracts\ProductService;
use App\Services\Contracts\UploadService;

class ProductController extends AbstractController
{
    protected $dataSelect = ['id','name','image','status','price','quantity','sale','price_sale','slug','user_id','code','provider_id'];

    protected $categoryRepository;

    protected $propertyRepository;

    protected $providerRepository;

    public function __construct(ProductRepository $product, CategoryRepository $category, PropertyRepository $property, ProviderRepository $provider)
    {
        parent::__construct($product);
        $this->categoryRepository = $category;
        $this->propertyRepository = $property;
        $this->providerRepository = $provider;
    }

    public function index()
    {
        $this->before(__FUNCTION__);
        parent::index();
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->products(),4);
        $this->compacts['providerList'] = $this->providerRepository->all()->prepend(null)->lists('name','id');

        return $this->viewRender();
    }

    public function getDataWithCategory($category)
    {
        $this->before('index');
        $category = $this->categoryRepository->findOrFail($category);
        $items = $category->products()->get($this->dataSelect);

        return $this->getData($items);
    }

    public function category($category)
    {
        $this->before('index');
        $this->compacts['category'] = $this->categoryRepository->findOrFail($category);
        return $this->index();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
        parent::create();
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->products(),4);
        $this->compacts['colorList'] = $this->propertyRepository->type('color')->lists('name','id');
        $this->compacts['brandList'] = $this->propertyRepository->type('brand')->lists('name','id')->prepend('Chọn','0');
        $this->compacts['groupProperty'] = $this->categoryRepository->properties();
        $this->compacts['providerList'] = $this->providerRepository->all()->lists('name','id')->prepend('Chọn','0');
        
        return $this->viewRender();
    }

    public function store(ProductRequest $request, ProductService $service)
    {
        $data = $request->all();
        return $this->storeData($data, $service);
    }

    public function show($id)
    {
        //parent::show($id);
        //return $this->viewRender();
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->before(__FUNCTION__,$this->compacts['item']);
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->products(),4);
        $this->compacts['brandList'] = $this->propertyRepository->type('brand')->lists('name','id')->prepend('Chọn','0');
        $this->compacts['colorList'] = $this->propertyRepository->type('color')->lists('name','id');
        $this->compacts['groupProperty'] = $this->categoryRepository->properties();
        $this->compacts['providerList'] = $this->providerRepository->all()->lists('name','id')->prepend('Chọn','0');

        return $this->viewRender();
    }

    public function update(ProductRequest $request, ProductService $service, $id)
    {
        $data = $request->all();
        //dd($data);
        return $this->updateData($data, $service, $id);
    }

    public function destroy(ProductService $service, $id)
    {
        return $this->deleteData($service, $id);
    }

    public function uploadImage(Request $request,UploadService $service)
    {
    	$validator = \Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:3000',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->messages()->first()], 400);
        }

        $url = $service->image($request->all());

        $image = app(\App\Eloquent\ProductImage::class)->create([
        		'name' => $request->file('image')->getClientOriginalName(),
                'image' => $url,
                'type' => $request->get('type')
        	]);

        return [
            'code' => 200,
            'id' => $image->id
        ];
    }
}
