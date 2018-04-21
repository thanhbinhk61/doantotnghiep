<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\PageRequest;
use App\Repositories\Contracts\PageRepository;
use App\Services\Contracts\PageService;

class PageController extends AbstractController
{
    protected $dataSelect = ['id','name','status','created_at','user_id'];

    public function __construct(PageRepository $page)
    {
        parent::__construct($page);
    }

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
    	return $this->viewRender();
    }

    public function create()
    {
    	parent::create();
        $this->before(__FUNCTION__);
    	return $this->viewRender();
    }

    public function store(PageRequest $request, PageService $service)
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

    public function update(PageRequest $request, PageService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(PageService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
