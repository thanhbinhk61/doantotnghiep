<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ShipRepository;
use App\Services\Contracts\ShipService;
use App\Services\Contracts\MailService;

class ShipController extends AbstractController
{
    protected $dataSelect = ['id','name','email','status','total','created_at','customer_id'];

    public function __construct(ShipRepository $ship)
    {
        parent::__construct($ship);
    }

    public function index()
    {
    	parent::index();
    	return $this->viewRender();
    }

    public function getData($items = null)
    {
        $this->before('index');
        return \Datatables::of($items ? $items : $this->repository->datatables($this->dataSelect))
        ->editColumn('name', function ($item) {
            return ($item->customer_id == 0) ? $item->name : $item->customer->name;
        })
        ->editColumn('email', function ($item) {
            return ($item->customer_id == 0) ? $item->email : $item->customer->email;
        })
        ->editColumn('status', function ($item) {
            return config('umzila.orderShip.' . $item->status);
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
        $this->compacts['orderStatus'] = config("umzila.orderShip");
    	return $this->viewRender();
    }

    public function update(Request $request, ShipService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id, null, function ($item) use ($data) {
            if (isset($data['sendmail']) && $data['sendmail']) {
            	app(MailService::class)->sendOrderShip($item, $data['reply']);
            }
        });
    }

    public function destroy(ShipService $service, $id)
    {
        return $this->deleteData($service, $id);
    }
}
