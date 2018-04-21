<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\ContactRepository;
use App\Services\Contracts\ContactService;

class ContactController extends AbstractController
{
    protected $dataSelect = ['id','name','email','phone','content'];

    public function __construct(ContactRepository $page)
    {
        parent::__construct($page);
    }

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
    	return $this->viewRender();
    }

    public function destroy(ContactService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
