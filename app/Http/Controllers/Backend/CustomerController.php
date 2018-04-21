<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\ProviderRepository;
use App\Http\Requests\Backend\CustomerProviderRequest;
use App\Services\Contracts\CustomerService;

class CustomerController extends AbstractController
{
    protected $dataSelect = ['id','name','phone','email','address','status','category_id','amount','provider_id'];

    protected $dataCategory = ['id','name'];

    protected $categoryRepository;

    protected $providerRepository;

    public function __construct(CustomerRepository $customer, CategoryRepository $category, ProviderRepository $provider)
    {
        parent::__construct($customer);
        $this->categoryRepository = $category;
        $this->providerRepository = $provider;
    }

    public function getData($items = null)
    {
        $this->before('index');
        return \Datatables::of($items ? $items : $this->repository->Datatables($this->dataSelect))
        ->editColumn('category_id', function ($item) {
            return (count($item->category)) ? $item->category->name : null;
        })
        ->addColumn('countOrder', function ($item) {
            return count($item->orders);
        })  
        ->addColumn('totalPriceOrder', function ($item) {
            return $item->orders->sum('total') + $item->amount;
        })
        ->editColumn('status', function ($item) {
            return ($item->status == 1) ? 'Enable' : 'Disable';
        })
        ->addColumn('actions', function ($item) {
            $actions = [];
                if ($this->before('show', $item, false)) {
                    $actions['show'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.show', $item->id),
                        'label' => $this->trans('show'),
                    ];
                }
                if ($this->before('edit', $item, false)) {
                    $actions['edit'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.edit', $item->id),
                        'label' => $this->trans('edit'),
                    ];
                }
                if ($this->before('delete', $item, false)) {
                    $actions['delete'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.destroy', $item->id),
                        'label' => $this->trans('delete'),
                    ];
                }
            return $actions;
        })->make(true);
    }

    public function getDataOrder($customerId)
    {
        $this->before('index');
    	$items = $this->repository->findOrFail($customerId)->orders;
    	if (!$items) return;
    	return \Datatables::of($items)
    	->editColumn('status', function ($item) {
    		return config("umzila.orderStatus.{$item->status}.name");
    	})
    	->make(true);
    }

    public function getDataProvider()
    {
        $this->before('index');
        $items = $this->repository->providers($this->dataSelect);
        if (!$items) return;
        return \Datatables::of($items)
        ->editColumn('provider_id', function ($item) {
            return ($item->provider) ? $item->provider->name : null;
        })
        ->editColumn('status', function ($item) {
            return ($item->status == 1) ? 'Enable' : 'Disable';
        })
        ->addColumn('actions', function ($item) {
            $actions = [];
                // if ($this->before('show', $item, false)) {
                //     $actions['show'] = [
                //         'uri' => route('admin.'.$this->repositoryName.'.show', $item->id),
                //         'label' => $this->trans('show'),
                //     ];
                // }

                if ($this->before('edit', $item, false)) {
                    $actions['edit'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.edit', $item->id),
                        'label' => $this->trans('edit'),
                    ];
                }
                
                if ($this->before('delete', $item, false)) {
                    $actions['delete'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.destroy', $item->id),
                        'label' => $this->trans('delete'),
                    ];
                }
            return $actions;
        })->make(true);
    }

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
        $categoryArray = $this->categoryRepository->customers($this->dataCategory)->lists('name','id')->all();
        $categoryArray[null] = 'Tất cả'; 
        $this->compacts['categoryList'] = $categoryArray;
    	return $this->viewRender();
    }

    public function provider()
    {
        $this->before('index');
        parent::index();
        $this->view = $this->repositoryName . '.provider';
        return $this->viewRender();
    }

    public function show($id)
    {
        $this->before(__FUNCTION__);
    	parent::show($id);
        $this->compacts['addresses'] = $this->compacts['item']->addresses;
    	$this->compacts['cards'] = $this->compacts['item']->cards;
    	return $this->viewRender();
    }

    public function createProvider()
    {
        $this->before(__FUNCTION__);
        parent::create();
        $this->view = $this->repositoryName . '.create-provider';
        $this->compacts['providerList'] = $this->providerRepository->all()->lists('name','id');
        return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
        parent::create();
        $this->compacts['categories'] = $this->categoryRepository->customers($this->dataCategory);
        $this->compacts['categoryList'] = $this->compacts['categories']->lists('name','id');
        return $this->viewRender();
    }

    public function storeProvider(CustomerProviderRequest $request, CustomerService $service)
    {
        $this->before('create');
        $data = $request->all();
        return $this->storeData($data, $service, route('admin.customer.provider'));
    }

    public function store(Request $request, CustomerService $service)
    {
        $this->before('create');
        $this->validate($request, ['category_id'=>'required','file' => 'sometimes|required']);
        $data = [
            'category_id' => $request->category_id,
            'file' => $request->file,
        ];
        try {
            $item = $service->import($data);
            $this->e['message'] = $this->trans('object_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_created_unsuccessfully');
        }
        if (method_exists($item, 'fails') && $item->fails()) {
            return redirect()->back()->withErrors($item)->withInput();
        }
        return redirect(route('admin.customer.index'))->with('flash_message',json_encode($this->e, true));
    }

    public function edit($id)
    {
        parent::edit($id);
        if ($this->compacts['item']->provider_id != 0) $this->compacts['heading'] = 'Nhà cung cấp';
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['categories'] = $this->categoryRepository->customers($this->dataCategory);
        $this->compacts['categoryList'] = $this->compacts['categories']->lists('name','id');
        return $this->viewRender();
    }

    public function update(CustomerProviderRequest $request, CustomerService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id, url()->previous());
    }

    public function destroy(CustomerService $service, $id)
    {
        return $this->deleteData($service, $id);
    }

    public function deleteAddress(CustomerService $service, $id)
    {
        $this->before(__FUNCTION__);
    	try {
            $service->deleteAddress($id);
            $this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true)); 
    }
}
