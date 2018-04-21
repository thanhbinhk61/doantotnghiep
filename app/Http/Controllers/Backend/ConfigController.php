<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ConfigRequest;
use App\Repositories\Contracts\ConfigRepository;
use App\Services\Contracts\ConfigService;

class ConfigController extends AbstractController
{
    public function __construct(ConfigRepository $config)
    {
        parent::__construct($config);
    }

    public function index()
    {
    	parent::index();
    	$this->compacts['item'] = $this->repository->all()->first();
    	return $this->viewRender();
    }

    public function update(ConfigRequest $request, ConfigService $service, $id)
    {
    	$data = $request->all();
        //$data['label'] = json_encode($request->label);
        //dd($data);
        \Cache::forget('configs');
        \Cache::forget('menuHead');
        \Cache::forget('menuLeft');
        \Cache::forget('categoryList');
        \Cache::forget('productRandom');
    	\Cache::forget('categoryRoots');
        \Cache::forget('menuFooter'); 
        return $this->updateData($data, $service, $id);
    }
}
