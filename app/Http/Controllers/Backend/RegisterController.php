<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\RegisterRepository;
use App\Services\Contracts\RegisterService;

class RegisterController extends AbstractController
{
    protected $dataSelect = ['id','name','status','email'];

    public function __construct(RegisterRepository $register)
    {
        parent::__construct($register);
    }

    public function index()
    {
    	parent::index();
    	return $this->viewRender();
    }

    public function edit($id)
    {
    	parent::edit($id);
        $this->before(__FUNCTION__,$this->compacts['item']);
    	return $this->viewRender();
    }

    public function update(Request $request, RegisterService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(RegisterService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
