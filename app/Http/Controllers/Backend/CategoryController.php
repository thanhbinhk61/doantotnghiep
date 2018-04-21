<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\CategoryRequest;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\SlideRepository;
use App\Services\Contracts\CategoryService;
use App\Services\Contracts\UploadService;

class CategoryController extends AbstractController
{
    protected $dataSelect = ['id','name','type','parent_id','icon_fa'];

    public function __construct(CategoryRepository $category)
    {
        parent::__construct($category);
    }

    public function index()
    {
        abort(401);
    }

    public function getDataWithType($type)
    {
        $this->before('index');
    	parent::index();
        $this->compacts['heading'] = $this->trans('category') . ' ' . $this->trans($type);
        if ($type != 'post' && $type != 'product') abort(401);
        $this->compacts['type'] = $type;
        $this->compacts['categories'] = $this->repository->rootWithType($type, $this->dataSelect);
        $this->compacts['listCategories'] = $this->recursiveList($this->repository->type($type),3,0,[0=>'chọn']);

        return $this->viewRender();
    }

    public function create()
    {
        abort(401);
    }

    public function store(CategoryRequest $request, CategoryService $service)
    {
        $data = $request->all();
        session()->flash('flash_parent', $request->parent_id);
        return $this->storeData($data, $service, url()->previous());
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
        $type = $this->compacts['item']->type;
        return $this->getDataWithType($type);
    }

    public function update(CategoryRequest $request, CategoryService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id, url()->previous());
    }

    public function destroy(CategoryService $service, $id)
    {
        return $this->deleteData($service, $id);
    }

    public function ajaxParent(Request $request)
    {
        $data = [];
        $idparent = $request->id;
        while ($idparent) {
            $idparent =  $this->repository->find($idparent)->parent_id;
            $data[] = $idparent;
        }
        return $data;
    }

    public function uploadImage(Request $request,UploadService $service)
    {
        $validator = \Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:3000',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->messages()->first()], 400);
        }

        $url = $service->image($request->all());

        $image = app(SlideRepository::class)->create([
                'image' => $url,
                'section' => 2,
                'status' => 1
            ]);

        return [
            'code' => 200,
            'id' => $image->id
        ];
    }
}
