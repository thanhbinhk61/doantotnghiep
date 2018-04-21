<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\PropertyRequest;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\PropertyService;

class PropertyController extends AbstractController
{
    protected $dataSelect = ['id','name','type','value','logo','status','category_id'];

    protected $dataCategory = ['id','name'];

    protected $categoryRepository;

    public function __construct(PropertyRepository $property, CategoryRepository $category)
    {
        parent::__construct($property);
        $this->categoryRepository = $category;
    }

    public function getData($items = null)
    {
        $this->before('index');
        return \Datatables::of($items ? $items : $this->repository->datatables($this->dataSelect))
        ->addColumn('category_id', function ($item) {
            return ($item->category) ? $item->category->name : '';
        })
        ->addColumn('actions', function ($item) {
            $actions = [];
                if ($this->before('show', $item, false)) {
                    $actions['show'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.show', $item->id),
                        'label' => $this->trans('show'),
                    ];
                }
                if ($this->before('edit', $item, false)) {
                    $actions['edit'] = [
                        'uri' => route('admin.'.$this->repositoryName.'.edit', $item->id),
                        'label' => $this->trans('edit'),
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

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
        $this->compacts['typies'] = config('umzila.property_group');
    	return $this->viewRender();
    }

    public function getDataWithType($type)
    {
        $this->before('index');
        $items = $this->repository->type($type,$this->dataSelect);
        return $this->getData($items);
    }

    public function type($type)
    {
        $this->before('index');
        $this->compacts['type'] = $type;
        return $this->index();
    }

    public function create()
    {
    	parent::create();
        $this->compacts['categories'] = $this->categoryRepository->properties($this->dataCategory);
    	return $this->viewRender();
    }

    public function store(PropertyRequest $request, PropertyService $service)
    {
    	$data = $request->all();
        session()->put('category_id', $request->category_id);
        session()->put('type', $request->type);
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
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['categories'] = $this->categoryRepository->properties($this->dataCategory);
    	return $this->viewRender();
    }

    public function update(PropertyRequest $request, PropertyService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(PropertyService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
