<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\SlideRepository;
use App\Repositories\Contracts\CommentRepository;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Services\Contracts\OrderService;
use App\Services\Contracts\ProductService;
use App\Services\Contracts\MailService;


class ProductController extends Controller
{
    protected $categoryRepository;

    protected $repository;

    protected $dataProperty = ['name','id'];

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

	public function __construct(ProductRepository $product)
    {
        $this->repository = $product;
    }

    public function show($slug)
    {
        $compacts['item'] = $this->repository->findBySlug($slug);
        $compacts['categoryProperty'] =  app(CategoryRepository::class)->properties($this->dataProperty);
        $compacts['productSame'] = $compacts['item']->categories->first()->productSame;
        $cookie = app(ProductService::class)->viewed($compacts['item']);
    	return ($cookie) ? \Response::make(view('frontend.product.show',$compacts))->withCookie($cookie) :
                            view('frontend.product.show',$compacts);
    }

    public function ajaxQuickview(Request $request)
    {
        $id = $request->value;
        $compacts['product'] = $this->repository->findOrFail($id);
        $compacts['colors'] = $compacts['product']->colors;
        $compacts['others'] = $compacts['product']->others->groupBy('category_id');
        $compacts['rating'] = (count($compacts['product']->getRating)) ? $compacts['product']->getRating->first()->rating : 0;
        return $compacts;
    }

    public function category($slug, $range = null, $colors = null, $brands = null)
    {
        $compacts['category'] = app(CategoryRepository::class)->findBySlug($slug);
        $compacts['categoryParent'] = ($compacts['category']->parent) ? ($compacts['category']->parent) : $compacts['category'];
        $compacts['categoryChildren'] = $compacts['categoryParent']->children;
        $compacts['colors'] = app(PropertyRepository::class)->type('color');
        $compacts['brands'] = app(PropertyRepository::class)->type('brand');
        if($range) {
            $compacts['rangePrice'] =  explode('_', $range);
            $compacts['colorFilter'] = ($colors && $colors != 0) ? explode('_', $colors) : null;
            $compacts['brandFilter'] = ($brands && $brands != 0) ? explode('_', $brands) : null;
            $products = $this->repository->categoryFilter($compacts['category']->id,$compacts['rangePrice'], $compacts['colorFilter'], $compacts['brandFilter']);
        }

        else {
            $products = $compacts['category']->products()->orderBy('id','DESC')->paginate(12);
        }
        $compacts['productCategory'] = $products;
        //$compacts['slides'] = app(SlideRepository::class)->getCategory(3);
        $compacts['slides'] = $compacts['category']->slides()->where('status','1')->orderBy('id','DESC')->get();
        return view('frontend.product.category',$compacts);
    }

    public function cartStore(Request $request, $id)
    {
        try {
            $product = app(ProductRepository::class)->find($id);
            $color_first = count($product->colors) ? $product->colors->first()->id : 0;
            $color_id = ($request->color_id != 0) ?  $request->color_id : $color_first;
            $other_ids = isset($request->other_ids) ?  $request->other_ids : [0];
            $others = [];
            foreach ($other_ids as $value) {
                $others[] = ($value != 0) ? $product->others->keyBy('id')[$value]['name'] : '';
            }
            $color = ($color_id != 0) ? $product->colors->keyBy('id')[$color_id]['name'] : '';
            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => isset($request->quantity) ? $request->quantity : 1,
                'price' => isset($request->price) ? $request->price : 0,
                'options' => [
                    'code' => $product->code,
                    'slug' => $product->slug,
                    'max_qty' => $product->quantity,
                    'color' => $color,
                    'color_id' => $color_id,
                    'other_ids' => $other_ids,
                    'others' => implode(', ', $others),
                    'image' => $product->image,
                    'brand_id'=> isset($product->brand->id) ? $product->brand->id : '',
                    'brand_name' => isset($product->brand->name) ? $product->brand->name : '',
                    'provider_slug' => isset($product->provider->slug) ? $product->provider->slug : '',
                    'provider_name' => isset($product->provider->name) ? $product->provider->name : ''
                    ],
                ]);
            $this->e['message'] = trans('repositories.cart_order_successfully');
        } catch (\Exception $e) {
            //dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositories.cart_order_unsuccessfully');
        }
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message_frontend', json_encode($this->e, true));
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function cartUpdate(Request $request)
    {
        if ($request->has('rowid')) {
            $rowId = $request->rowid;
            $quantity = $request->quantity;
            \Cart::update($rowId, ['qty' => $quantity]);
        }
        $data = [
            'subtotal' => \Cart::get($rowId)->subtotal,
            'total' => \Cart::total(),
            'quantity' => \Cart::count()
        ];
        return $data;
    }

    public function cart()
    {
        $compacts['carts'] = \Cart::content();
        return view('frontend.order.cart',$compacts);
    }
    
    public function cartDelete($id)
    {   
        try {
            \Cart::remove($id);
            $this->e['message'] = trans('repositories.cart_delete_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.cart_delete_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function cartCheckout(CheckoutRequest $request, OrderService $service, MailService $mail)
    {
        if (\Cart::count() == 0) return;
        $data = $request->all();
        try {
            $order = $service->store($data);
            $this->e['message'] = trans('repositories.cart_checkout_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.cart_checkout_unsuccessfully');
        }
        $mail->send($order->toArray());
        \Cart::destroy();
        $url = ($order) ? route('product.cart.success',$order->id) : url()->previous();
        return redirect($url)->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function postComment(Request $request)
    {
        $data = $request->all();
        $data['status'] = 2;
        try {
            app(CommentRepository::class)->create($data);
            $this->e['message'] = trans('repositories.post_comment_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.post_comment_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function search(Request $request)
    {
        $compacts['value'] = $request->search;
        $compacts['productSearch'] = $this->repository->search($compacts['value']);
        return view('frontend.product.search',$compacts);
    }

    public function ajaxSearch(Request $request)
    {
        $attributes = ['name','image','code','slug'];
        $results = $this->repository->ajaxSearch($request->input('query'),$attributes);
        return $results;
    }
}
