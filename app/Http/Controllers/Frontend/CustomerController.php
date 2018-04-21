<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CustomerUpdateRequest;
use App\Http\Requests\Frontend\CustomerAddressRequest;
use App\Http\Requests\Frontend\CustomerCardRequest;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Services\Contracts\CustomerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    protected $repository;

    protected $guard = 'frontend';

    protected $customer;

    protected $exportTo;

    const DATEFORMAT = 'm/d/Y';

    protected $dateRange = [];
    protected $dateGroup = 'date';
    protected $dateFormat = null;
    protected $dateFormats = array(
        'date' => ['Y-m-d', 'Y-m-d'],
        'month' => ['m', 'Y-m'],
        'year' => ['Y', 'Y'],
    );

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

    public function __construct(Request $request, CustomerRepository $customer)
    {
        $this->middleware('auth:frontend');
        $this->repository = $customer;
        $this->customer = \Auth::guard('frontend')->user();
        if ($request->has('export')) {
            $this->exportTo = $request->export;
        }
        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->get('date_range'));
            $this->dateRange = array_map(function ($date) {
                return Carbon::createFromFormat(self::DATEFORMAT, $date);
            }, $dates);
        } else {
            $this->dateRange = array(Carbon::now()->subDays(30), Carbon::now());
        }
        if ($request->has('date_group') && array_key_exists($request->get('date_group'), $this->dateFormats)) {
            $this->dateGroup = $request->get('date_group');
        }
        $this->compacts['dateRange'] = implode(' - ', array_map(function ($date) {
            return $date->format(self::DATEFORMAT);
        }, $this->dateRange));
        $this->dateFormat = $this->dateFormats[$this->dateGroup];
        $this->compacts['dateGroup'] = $this->dateGroup;
        $this->compacts['dateFormat'] = $this->dateFormat;
    }

    public function index()
    {
        $compacts['item'] = $this->customer;
        $compacts['shipList'] = app(ExpenseRepository::class)->isActive(['name','id'])->lists('name','id')->prepend('Chọn khu vực',0);
        return view('frontend.customer.index',$compacts);
    }

    public function update(CustomerUpdateRequest $request, CustomerService $service)
    {
        $data = $request->all();
        try {
            $service->update($this->customer, $data);
            $this->e['message'] = trans('repositories.customer_updated_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.customer_updated_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function postAddress(CustomerAddressRequest $request, CustomerService $service)
    {
        $data = $request->all();
        try {
            $service->storeAddress($data);
            $this->e['message'] = trans('repositories.address_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.address_created_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function deleteAddress(CustomerService $service, $id)
    {
        try {
            $service->deleteAddress($id);
            $this->e['message'] = trans('repositories.address_deleted_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.address_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message_frontend', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));  
    }

    public function addWishList(CustomerService $service, $id)
    {
    	try {
            $service->wishList($id);
            $this->e['message'] = trans('repositories.wishlist_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.wishlist_created_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message_frontend', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function deleteWishlist(CustomerService $service, $id)
    {
        try {
            $service->wishlist($id, 'delete');
            $this->e['message'] = trans('repositories.wishlist_deleted_successfully');
        } catch (\Exception $e) {
            //dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositories.wishlist_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message_frontend', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));   
    }

    public function wishList()
    {
        $compacts['items'] = $this->customer->products()->paginate(10);
        return view('frontend.customer.wishlist',$compacts);
    }

    public function order()
    {
        $compacts['items'] = $this->customer->orders()->paginate(10);
        $compacts['items']->load('products');       
        return view('frontend.customer.order', $compacts);
    }

    public function showOrder($code, $print = null)
    {
        $compacts['item'] = $this->customer->findOrderByCode($code);
        $compacts['products'] = $compacts['item']->products->load('others');
        $compacts['address'] = $compacts['item']->addressCustomer;
        return ($print) ? view('frontend.customer.print_order',$compacts) : view('frontend.customer.show_order', $compacts);
    }

    public function card()
    {
        $compacts['items'] = $this->customer->cards()->paginate(5);
        return view('frontend.customer.card',$compacts);
    }

    public function postCard(CustomerCardRequest $request, CustomerService $service)
    {
        $data = $request->all();
        try {
            $service->storeCard($data);
            $this->e['message'] = trans('repositories.card_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositories.card_created_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function deleteCard(CustomerService $service, $id)
    {
        try {
            $service->deleteCard($id);
            $this->e['message'] = trans('repositories.card_deleted_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.card_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message_frontend', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));  
    }

    public function providerStatistic()
    {
        $providerId = $this->customer->provider_id;
        if (!$providerId || $this->customer->status == 2) return abort(404, 'Bạn không có quyền truy cập');
        $compacts['items'] = app(ProductRepository::class)->byOrderProvider($providerId);
        $compacts = array_merge($compacts, $this->compacts);
        if ($this->exportTo) {
            return Excel::create($this->getExcelName(), function ($excel) use ($compacts) {
                $excel->setTitle($this->getExcelTitle());
                $excel->setCreator($this->customer->name);
                $excel->sheet('New sheet', function($sheet) use ($compacts) {
                    $sheet->loadView('frontend.customer.provider_excel', $compacts);
                });
            })->download($this->exportTo);
        }
        return view('frontend.customer.provider', $compacts);
    }

    protected function getExcelName()
    {
        return str_slug(implode(' ', [
            "Thông kê sản phẩm của nhà cung cấp theo {$this->dateGroup}",
            $this->compacts['dateRange']
        ]));
    }

    protected function getExcelTitle()
    {
        return Str::ascii("Thống kê sản phẩm của nhà cung cấp theo {$this->dateGroup}");
    }
}
