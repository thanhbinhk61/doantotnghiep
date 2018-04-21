<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\UserRequest;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserService;
use Bouncer;

class UserController extends AbstractController
{
    protected $dataSelect = ['id','name','username','email'];

    protected $roleList;

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
        $this->roleList = Bouncer::role()->where('id','<>',1)->lists('name','id');
    }

    public function index()
    {
        $this->before(__FUNCTION__);
        parent::index();
        $this->compacts['roles'] = $this->roleList;
        return $this->viewRender();
    }

    public function getDataWithRole($role)
    {
        $this->before(__FUNCTION__);
        $role = Bouncer::role()->findOrFail($role);
        $items = $role->users()->get($this->dataSelect);
        return $this->getData($items);
    }

    public function role($role)
    {
        $this->before(__FUNCTION__);
        $this->compacts['role'] = Bouncer::role()->findOrFail($role);
        return $this->index();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
    	parent::create();
        $this->compacts['roles'] = $this->roleList;
    	return $this->viewRender();
    }

    public function store(UserRequest $request, UserService $service)
    {
        $data = $request->all();
        return $this->storeData($data, $service);
    }

    public function show($id)
    {
        parent::show($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
        return $this->viewRender();
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['roles'] = $this->roleList;
        return $this->viewRender();
    }

    public function update(UserRequest $request, UserService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(UserService $service, $id)
    {
        return $this->deleteData($service, $id);
    }
}
