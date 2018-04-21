<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CouponRequest;
use App\Repositories\Contracts\CouponRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\CouponService;
use App\Eloquent\CouponCode;

class CouponController extends AbstractController
{
    protected $dataSelect = ['id','name','value','type','expired_at','status'];

    protected $dataCategory = ['id','name'];

    protected $categoryRepository;

    public function __construct(CouponRepository $coupon, CategoryRepository $category)
    {
        parent::__construct($coupon);
        $this->categoryRepository = $category;
    }

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
    	return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
    	parent::create();
        $this->compacts['categories'] = $this->categoryRepository->customers($this->dataCategory)->lists('name','id');
    	return $this->viewRender();
    }

    public function store(CouponRequest $request, CouponService $service)
    {
    	$data = $request->all();
        return $this->storeData($data, $service);
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['categories'] = $this->categoryRepository->customers($this->dataCategory)->lists('name','id');
        $this->compacts['codes'] = $this->compacts['item']->codes()->paginate(10);
        return $this->viewRender();
    }

    public function update(CouponRequest $request, CouponService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(CouponService $service, $id)
    {
        return $this->deleteData($service, $id);
    }

    public function deleteCode($id)
    {
        $this->before(__FUNCTION__);
        try {
            app(CouponCode::class)->findOrFail($id)->delete();
            $this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
            //dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true)); 
    }
}
