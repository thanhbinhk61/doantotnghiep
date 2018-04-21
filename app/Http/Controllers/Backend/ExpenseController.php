<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ExpenseRequest;
use App\Repositories\Contracts\ExpenseRepository;
use App\Services\Contracts\ExpenseService;

class ExpenseController extends AbstractController
{
    protected $dataSelect = ['id','name','status','price'];

    public function __construct(ExpenseRepository $expense)
    {
        parent::__construct($expense);
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

    public function store(ExpenseRequest $request, ExpenseService $service)
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
    	return $this->viewRender();
    }

    public function update(ExpenseRequest $request, ExpenseService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(ExpenseService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
