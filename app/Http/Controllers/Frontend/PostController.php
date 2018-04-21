<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\CategoryRepository;

class PostController extends Controller
{
    protected $repository; 

    protected $categoryRepository;

    public function __construct(PostRepository $post, CategoryRepository $category)
    {
    	$this->repository = $post;
    	$this->categoryRepository = $category;
    }

    public function show($slug)
    {
    	$compacts['item'] = $this->repository->findByslug($slug);
    	$compacts['postSame'] = $compacts['item']->categories->first()->postSame;
    	//$compacts['postCategory'] = $this->categoryRepository->rootWithType('post');
    	return view('frontend.post.show',$compacts);
    }

    public function category($slug)
    {
    	$compacts['category'] = $this->categoryRepository->findByslug($slug);
    	$compacts['postCategory'] = $compacts['category']->posts()->with('user')->orderBy('id','DESC')->paginate(12);
    	return view('frontend.post.category',$compacts);
    }
}
