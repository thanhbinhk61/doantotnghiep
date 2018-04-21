<?php

namespace App\Http\Controllers\Backend;

use Bouncer;
use App\Http\Requests\Backend\RoleRequest;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\RoleService;

class RoleController extends AbstractController
{
    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index()
    {
        $this->before(__FUNCTION__,app(\Silber\Bouncer\Database\Role::class));
    	$this->view = 'role.index';
        $this->compacts['heading'] = "Danh sách nhóm quyền";
        $this->compacts['roles'] = Bouncer::Role()->where('id','<>',1)->with('abilities')->get();
        return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__,app(\Silber\Bouncer\Database\Role::class));
    	$this->view = 'role.create';
    	$this->compacts['heading'] = "Thêm nhóm quyền";
    	$this->compacts['abilities'] = Bouncer::Ability()->all()->groupBy(function ($item, $key) {
            $parts = explode('-', $item->name);
            $item->name = $parts[1] . '-' . trans('repositories.'.$parts[0]);
            return $parts[0];
        });
        return $this->viewRender();
    }

    public function store(RoleRequest $request, RoleService $service)
    {
        $this->before(__FUNCTION__,app(\Silber\Bouncer\Database\Role::class));
    	$data = $request->all();
        try {
            $item = $service->store($data);
            $this->e['message'] = $this->trans('object_created_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_created_unsuccessfully');
        }
        return redirect(route('admin.role.index'))->with('flash_message',json_encode($this->e, true));
    }

    public function edit($id)
    {
        $this->view = 'role.edit';
        $this->compacts['heading'] = "Cập nhật nhóm quyền";
        $this->compacts['item'] = Bouncer::Role()->findOrFail($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['abilities'] = Bouncer::Ability()->all()->groupBy(function ($item, $key) {
            $parts = explode('-', $item->name);
            $item->name = $parts[1] . '-' . trans('repositories.'.$parts[0]);
            return $parts[0];
        });
        return $this->viewRender();
    }

    public function update(RoleRequest $request, RoleService $service, $id)
    {
    	$data = $request->all();
    	$item = Bouncer::Role()->findOrFail($id);
        $this->before(__FUNCTION__, $item);
    	try {
    		$service->update($item, $data);
    		$this->e['message'] = $this->trans('object_updated_successfully');
    	} catch (\Exception $e) {
    		$this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_updated_unsuccessfully');
    	}
    	return redirect(route('admin.role.index'))->with('flash_message',json_encode($this->e, true));
    }

    public function destroy(RoleService $service, $id)
    {
        $item = Bouncer::Role()->findOrFail($id);
        $this->before(__FUNCTION__, $item);
        try {
        	$service->delete($item);
        	$this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
        	$this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message', json_encode($this->e, true));
        }
        return redirect(route('admin.role.index'))->with('flash_message',json_encode($this->e, true));
    }
}
