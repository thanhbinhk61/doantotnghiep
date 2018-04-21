<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\SlideRequest;
use App\Repositories\Contracts\SlideRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\SlideService;

class SlideController extends AbstractController
{
    protected $dataSelect = ['id','name','status','section','image','category_id'];

    protected $categoryRepository;

    public function __construct(SlideRepository $slide, CategoryRepository $category)
    {
        parent::__construct($slide);
        $this->categoryRepository = $category;
    }

    public function index()
    {
        $this->before(__FUNCTION__);
    	parent::index();
    	return $this->viewRender();
    }

    public function getData($items = null)
    {
        $this->before('index');
        return \Datatables::of($items ? $items : $this->repository->Datatables($this->dataSelect))
        ->addColumn('category', function ($item) {
            return $item->category ? $item->category->name : null;
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

    public function create()
    {
        $this->before(__FUNCTION__);
    	parent::create();
        $this->compacts['categoryList'] = $this->recursiveList($this->categoryRepository->products());
    	return $this->viewRender();
    }

    public function store(SlideRequest $request, SlideService $service)
    {
    	$data = $request->all();
        return $this->storeData($data, $service);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    	parent::edit($id);
        $this->before(__FUNCTION__, $this->compacts['item']);
        $this->compacts['categoryList'] = $this->recursiveList($this->categoryRepository->products());
    	return $this->viewRender();
    }

    public function update(SlideRequest $request, SlideService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(SlideService $service, $id)
    {
    	return $this->deleteData($service, $id);
    }
}
