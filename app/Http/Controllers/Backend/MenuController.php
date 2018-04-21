<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\MenuRequest;
use App\Repositories\Contracts\MenuRepository;
use App\Repositories\Contracts\PageRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\MenuService;
use App\Services\Contracts\UploadService;

class MenuController extends AbstractController
{
    protected $dataSelect = ['id','name','type','order','parent_id'];

    protected $categoryRepository;

    protected $pageRepository;

    public function __construct(MenuRepository $menu, CategoryRepository $category, PageRepository $page)
    {
        parent::__construct($menu);
        $this->categoryRepository = $category;
        $this->pageRepository = $page;
    }

    public function index()
    {
    	abort(401);
    }

    public function getDataWithSection($section)
    {
        $this->before('index');
        parent::index();
        if ($section != 'head' && $section != 'footer' && $section != 'left') abort(401);
        $this->compacts['section'] = $section;
        $this->compacts['menus'] = $this->repository->root($section);
        $this->compacts['pages'] = $this->pageRepository->all()->lists('name','id');
        $this->compacts['categoryProd'] = $this->categoryRepository->products()->lists('name','id');
        $this->compacts['categoryPost'] = $this->categoryRepository->posts()->lists('name','id');
        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->before(__FUNCTION__);
        if ( $request->has('value') )
        {
            $data = json_decode($request->value);
            $results = [];
            if ( !$data ) return 'error';
            foreach ($data as $item) {
                $result = $this->repository->create([
                        'name'=>$item->name,
                        'section'=>$item->section,
                        'type'=>$item->type,
                        'type_id' => $item->type_id,
                        'link' => $item->link,
                        ]);
                $results[] = $result;
            }
            return $results;
        }
    }

    public function update(Request $request, UploadService $service, $id)
    {
        $this->before(__FUNCTION__);
        $data = $request->all();
        try {
            \Cache::forget('menuHead'); 
            \Cache::forget('menuLeft'); 
            \Cache::forget('menuFooter'); 
            if (isset($data['image'])) {
                $data['image'] = $service->image($request->all());
            }
            $menu = $this->repository->find($id);
            $this->repository->update($menu, $data);
            $this->e['message'] = $this->trans('object_updated_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_updated_unsuccessfully');
        }
        return redirect(url()->previous())->with('flash_message',json_encode($this->e, true));   
    }

    public function updateSortMenu($jsonArray, $parent = 0, $order = 0)
    {
        $this->before(__FUNCTION__);
        if( $jsonArray )
        {
            foreach ($jsonArray as $item) {
                $order++;
                if ( isset($item->children) ) $this->updateSortMenu($item->children, $item->id,$order);
                $entity = $this->repository->find($item->id);
                $this->repository->update($entity, ['order'=>$order,'parent_id'=>$parent]);
            }
        }
    }

    public function ajaxUpdate(Request $request)
    {
        $this->before(__FUNCTION__);
        if ( $request->has('value') )
        {   
            \Cache::forget('menuHead'); 
            \Cache::forget('menuLeft'); 
            \Cache::forget('menuFooter'); 
            $data = json_decode($request->value);
            $this->updateSortMenu($data);
            $this->e['message'] = $this->trans('object_updated_successfully');
            return session()->flash('flash_message', json_encode($this->e, true));
        }
    }

    public function destroy($id)
    {
        $this->before(__FUNCTION__);
    	$this->repository->destroy($id);
        $this->e['message'] = $this->trans('object_deleted_successfully');
        return session()->flash('flash_message', json_encode($this->e, true));
    }
}
