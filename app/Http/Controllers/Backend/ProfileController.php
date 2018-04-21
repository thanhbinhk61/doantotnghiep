<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ProfileRequest;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserService;

class ProfileController extends AbstractController
{
    protected $dataSelect = ['id','name','username','email'];

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function userShow()
    {
    	$this->view = 'profile.show';
    	$this->compacts['item'] = $this->user;
        $this->compacts['heading'] = $this->trans('object.show');
        return $this->viewRender();
    }

    public function userEdit()
    {
    	$this->view = 'profile.edit';
    	$this->compacts['item'] = $this->user;
        $this->compacts['heading'] = $this->trans('object.edit');
        return $this->viewRender();
    }

    public function userUpdate(ProfileRequest $request, UserService $service)
    {
    	$item = $this->user;
        try {
            $service->update($item, $request->all());
            $this->e['message'] = $this->trans('object_updated_successfully');
        } catch (\Exception $e) {
            //dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_updated_unsuccessfully');
        }
        return redirect(route('admin.profile'))->with('flash_message',json_encode($this->e, true));
    }
}
