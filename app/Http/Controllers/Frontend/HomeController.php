<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SlideRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\ProviderRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\RegisterRepository;
use App\Repositories\Contracts\PageRepository;
use App\Http\Requests\Frontend\ContactRequest;
use App\Http\Requests\Frontend\ShipRequest;
use App\Http\Requests\Frontend\StoreRequest;
use App\Services\Contracts\ContactService;
use App\Services\Contracts\RegisterService;
use App\Services\Contracts\ShipService;

class HomeController extends Controller
{
	protected $repository; 

    protected $slideRepository;

    protected $postRepository;

	protected $providerRepository;

    protected $propertyRepository;

    protected $categoryRepository;

    protected $pageRepository;

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

	public function __construct(
        CategoryRepository $category, 
        SlideRepository $slide, 
        PostRepository $post, 
        ProviderRepository $provider,
        PropertyRepository $property,
        PageRepository $page
        )
    {
        $this->repository = $category;
        $this->slideRepository = $slide;
        $this->postRepository = $post;
        $this->providerRepository = $provider;
        $this->propertyRepository = $property;
        $this->categoryRepository = $category;
        $this->pageRepository = $page;
    }
    public function index()
    {
        $compacts['categoryRoot'] = $this->repository->productHome(4);
        $compacts['slides'] = $this->slideRepository->getHome(3);
        $compacts['postFeature'] = $this->categoryRepository->postHomeFeature(3);
        //$compacts['posts'] = $this->postRepository->getHome(6);
        $compacts['providers'] = $this->providerRepository->getActive(18);
    	$compacts['brands'] = $this->propertyRepository->getBrand(18);
    	return view('frontend.home.index',$compacts);
    }

    public function postContact(ContactRequest $request, ContactService $service)
    {
        try {
            $item = $service->store($request->all());
            $this->e['code'] = 0;
            $this->e['message'] = trans('repositories.contact_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositories.contact_created_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function page($slug)
    {
        $compacts['item'] = $this->pageRepository->findByslug($slug);
        return view('frontend.home.page',$compacts);
    }

    public function register()
    {
        $compacts['companyType'] = config('umzila.registerProvider.companyType');
        $compacts['categories'] = config('umzila.registerProvider.categories');
        $compacts['services'] = config('umzila.registerProvider.services');
        return view('frontend.home.register',$compacts);
    }

    public function postRegister(StoreRequest $request, RegisterService $service)
    {
        $data = $request->all();
        try {
            $service->store($data);
            $this->e['message'] = trans('repositories.store_created_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.store_created_unsuccessfully');
        }
        return redirect('/')->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function getShip()
    {
        return view('frontend.home.order_ship');
    }

    public function postShip(ShipRequest $request, ShipService $service)
    {
        $jsonLink = [];
        $data = $request->all();
        foreach ($data['link'] as $key => $val) {
            $jsonLink[] =[
                'link' => isset($val) ? $val : null,
                'description' => isset($data['description'][$key]) ? $data['description'][$key] : null
            ];
        }
        $data['info'] = json_encode($jsonLink);
        if (\Auth::guard('frontend')->check()) {
            $data['customer_id'] = \Auth::guard('frontend')->user()->id;
        }
        try {
            $service->store($data);
            $this->e['message'] = trans('repositories.ship_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.ship_created_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

}
