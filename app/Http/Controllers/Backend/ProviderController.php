<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\ProviderRequest;
use App\Repositories\Contracts\ProviderRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Services\Contracts\ProviderService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Excel;

class ProviderController extends AbstractController
{
    protected $dataSelect = ['id','name','phone','email','status'];

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

    public function __construct(Request $request, ProviderRepository $provider)
    {
        parent::__construct($provider);

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
        $this->before(__FUNCTION__);
    	parent::index();
    	return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
    	parent::create();
    	return $this->viewRender();
    }

    public function store(ProviderRequest $request, ProviderService $service)
    {
    	$data = $request->all();
        return $this->storeData($data, $service);
    }

    public function show($id)
    {
    	parent::show($id);
        $this->compacts['providerId'] = $id;
        $this->compacts['items'] = app(ProductRepository::class)->byOrderProvider($id);
        if ($this->exportTo) {
            return Excel::create($this->getExcelName(), function ($excel) {
                $excel->setTitle($this->getExcelTitle());
                $excel->setCreator($this->compacts['item']->name);
                $excel->sheet('New sheet', function($sheet) {
                    $sheet->loadView('frontend.customer.provider_excel', $this->compacts);
                });
            })->download($this->exportTo);
        }
    	return $this->viewRender();
    }

    public function edit($id)
    {
    	parent::edit($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
    	return $this->viewRender();
    }

    public function update(ProviderRequest $request, ProviderService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(ProviderService $service, $id)
    {
    	return $this->deleteData($service, $id);
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
