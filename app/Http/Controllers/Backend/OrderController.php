<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\OrderRepository;
use App\Services\Contracts\OrderService;
use App\Services\Contracts\MailService;

class OrderController extends AbstractController
{
    protected $dataSelect = ['id','code','name','status','total','created_at','customer_id','ship','coupon_id','expense_id'];

    public function __construct(OrderRepository $order)
    {
        parent::__construct($order);
    }

    public function index()
    {
    	parent::index();
        $data[null] = 'Tất cả';
        foreach (config('umzila.orderStatus') as $key => $value) {
            $data[$key] = $value['name'];
        }
        $this->compacts['optionStatus'] = $data;
        unset($this->compacts['optionStatus'][1]);
    	return $this->viewRender();
    }

    public function getData($items = null)
    {
        $this->before('index');
        return \Datatables::of($items ? $items : $this->repository->datatables($this->dataSelect))
        ->editColumn('name', function ($item) {
            return ($item->customer_id == 0) ? $item->name : $item->customer->name;
        })
        ->editColumn('status', function ($item) {
            return config("umzila.orderStatus.{$item->status}.name");
        })
        ->addColumn('actions', function ($item) {
            $actions = [];
                if ($this->before('show', $item, false)) {
                    $actions['show'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.show', $item->id),
                        'label' => $this->trans('show'),
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

    public function show($id)
    {
    	parent::show($id);
        $data = [];
        foreach (config('umzila.orderStatus') as $key => $value) {
            $data[$key] = $value['name'];
        }
        $this->compacts['optionStatus'] = $data;
        $this->compacts['products'] = $this->compacts['item']->products->load('others');
    	return $this->viewRender();
    }

    public function update(Request $request, OrderService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id, null, function ($item) use ($data) {
            app(MailService::class)->sendOrderStatus($item, $data['status']);
        });
    }

    public function destroy(OrderService $service, $id)
    {
        return $this->deleteData($service, $id);
    }
}
