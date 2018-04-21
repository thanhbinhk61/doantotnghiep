<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\PostRequest;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Services\Contracts\PostService;

class PostController extends AbstractController
{
    protected $dataSelect = ['id','name','image','status','user_id'];

    protected $categoryRepository;

    public function __construct(PostRepository $post, CategoryRepository $category)
    {
        parent::__construct($post);
        $this->categoryRepository = $category;
    }

    public function index()
    {
        $this->before(__FUNCTION__);
        parent::index();
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->posts(),4);

        return $this->viewRender();
    }

    public function getDataWithCategory($category)
    {
        $this->before('index');
        $category = $this->categoryRepository->findOrFail($category);
        $items = $category->posts()->get($this->dataSelect);
        return $this->getData($items);
    }

    public function category($category)
    {
        $this->before('index');
        $this->compacts['category'] = $this->categoryRepository->findOrFail($category);
        return $this->index();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
        parent::create();
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->posts(),4);
        
        return $this->viewRender();
    }

    public function store(PostRequest $request, PostService $service)
    {
        $data = $request->all();
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
        $this->compacts['categories'] = $this->recursiveList($this->categoryRepository->posts(),4);
        return $this->viewRender();
    }

    public function update(PostRequest $request, PostService $service, $id)
    {
        $data = $request->all();
        return $this->updateData($data, $service, $id);
    }

    public function destroy(PostService $service, $id)
    {
        return $this->deleteData($service, $id);
    }
}
