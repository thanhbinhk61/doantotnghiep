<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepository;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\CouponRepository;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\OrderService;
use App\Services\Contracts\MailService;
use App\Eloquent\CouponCode;
use Carbon\Carbon;

class OrderController extends Controller
{
    protected $repository;

    protected $dataProperty = ['name','id'];

    protected $checkAuth;

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

    public function __construct(OrderRepository $order)
    {
        $this->repository = $order;
        $this->checkAuth = ( \Auth::guard('frontend')->check() ) ? true : false;
    }

    public function guest()
    {
        if (\Cart::count() == 0) return abort(404, 'Không có gì trong giỏ hàng');
        if (!$this->checkAuth) {
        	if (session()->has('orderId')) {
        		return redirect(route('order.info'));
        	}
            $compacts['shipList'] = app(ExpenseRepository::class)->isActive(['name','id'])->lists('name','id')->prepend('Chọn khu vực',0);
            return view('frontend.order.guest',$compacts);
        } else {
            return redirect(route('order.info'));
        }
    }

    public function info()
    {	
    	if (\Cart::count() == 0) return abort(404, 'Không có gì trong giỏ hàng');
    	if (!session()->has('orderId') && !$this->checkAuth) return abort(404);
    	if ($this->checkAuth) {
            session()->forget('orderId');
    	}
        if (session()->has('orderId')) {
            $compacts['order'] = app(OrderRepository::class)->findOrFail(session('orderId'));
        }
        $compacts['shipList'] = app(ExpenseRepository::class)->isActive(['name','id'])->lists('name','id')->prepend('Chọn khu vực',0);
        $compacts['headding'] = 'Thông tin đơn hàng';
        
        return view('frontend.order.info',$compacts);
    }

    public function guestCheckout(CheckoutRequest $request, OrderService $service)
    {
    	if (\Cart::count() == 0) return abort(404);
        $data = $request->all();
        try {
            $orderId = $service->guest($data);
            session()->put('orderId', $orderId);
        } catch (\Exception $e) {
            abort(404, $e);
        }
        return redirect(route('order.info'));
    }

    public function updateGuest(CheckoutRequest $request, OrderService $service, $id)
    {
    	if (\Cart::count() == 0) return abort(404);
        $data = $request->all();
        $item = $this->repository->findOrFail($id);
        try {
            $orderId = $service->updateGuest($item, $data);
            $this->e['message'] = trans('repositories.guest_updated_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositories.guest_updated_unsuccessfully');
        }
        return \Redirect::back()->with('flash_message_frontend',json_encode($this->e, true));
    }

    public function paymentStore(Request $request, OrderService $service, MailService $mail)
    {
        $codeCoupon = $request->has('c') ? $request->c : null;
        $addressId = $request->has('a') ? $request->a : null;
        $cardId = $request->has('card') ? $request->card : null;
        $orderId = session()->has('orderId') ? session('orderId') : null;
        if (!session()->has('orderId') && !$this->checkAuth) {
            $this->e['code'] = 100;
            $this->e['message'] = 'Bạn chưa cập nhật thông tin';
            session()->flash('flash_message_frontend', json_encode($this->e, true));
            return [
                'route' => route('product.cart')
            ];
        }
        if ($this->checkAuth && !$addressId) {
            $this->e['code'] = 100;
            $this->e['message'] = 'Bạn chưa chọn địa chỉ';
            session()->flash('flash_message_frontend', json_encode($this->e, true));
            return [
                'route' => route('order.info')
            ];
        }
        try {
        	$order =  $service->payment($codeCoupon, $addressId, $orderId, $cardId);
            $this->e['message'] = trans('repositories.cart_checkout_successfully');
        } catch (\Exception $e) {
        	$order = null;
            $this->e['code'] = 100;
            $this->e['message'] = trans('repositoreis.cart_checkout_unsuccessfully');
            session()->flash('flash_message_frontend', json_encode($this->e, true));
            return [
                'route' => route('order.info')
            ];
        }
        if ($order) {
            \Cart::destroy();
            session()->flash('order',$order);        
            session()->forget('orderId');
            $mail->sendOrder($order);
        }
        $url = ($order) ? route('order.payment.success') : url()->previous();
        session()->flash('flash_message_frontend', json_encode($this->e, true));
        return [
            'route' => $url
        ];
    }

    public function postFind(Request $request)
    {
        if ($this->checkAuth) {
            return redirect(route('customer.order.show',$request->code));
        } else {
            $compacts['item'] = $this->repository->findByAttribute($request->code, $request->email);
            if ($compacts['item']) {
                $compacts['products'] = $compacts['item']->products->load('others');
            }
            return view('frontend.order.find',$compacts);
        }
    }

    public function paymentSuccess()
    {
        if (!session()->has('order')) abort(404);
        $compacts['order'] = session('order');
        $compacts['products'] = $compacts['order']->products->load('others');
        $compacts['addressCustomer'] = $compacts['order']->addressCustomer;        
        
        return view('frontend.order.success',$compacts);
    }

    public function ajaxExpense(Request $request)
    {
        return app(ExpenseRepository::class)->find($request->id);
    }

    public function ajaxCoupon($code)
    {
    	$coupon = app(CouponCode::class)->getCouponByCode($code);
        
        return $this->checkCoupon($coupon);
    }

    public function checkCoupon($coupon)
    {
        if (!$coupon) {
            return $result = [
                    'e' => 100,
                    'message' => 'Mã giảm giá không đúng.'
                ];
        } elseif ($coupon->status != 1) {
            return $result = [
                    'e' => 100,
                    'message' => 'Mã giảm giá đã bị khóa.'
                ];
        } elseif ($coupon->expired_at < Carbon::now()) {
            return $result = [
                    'e' => 100,
                    'message' => 'Mã giảm giá đã hết thời gian sử dụng.'
                ];
        } elseif ($coupon->min > \Cart::total()) {
            return $result = [
                    'e' => 100,
                    'message' => 'Mã giảm giá chỉ áp dụng cho đơn hàng lơn hơn ' . number_format($coupon->min) . ' ₫'
                ];
        } else {
            $value = ($coupon->type == 1) ? $coupon->value . ' %' : number_format($coupon->value) . ' ₫';
                $result  = [
                        'e' => 0,
                        'message' => "Bạn đưọc khuyến mại {$value} của tổng gía trị đơn hàng."
                    ];
            if (count($coupon->categories)) {
                if ($this->checkAuth && isset(\Auth::guard('frontend')->user()->category->id) && isset($coupon->categories->keyBy('id')[\Auth::guard('frontend')->user()->category->id])) {
                    return $result;
                } else {
                    return $resultError  = [
                            'e' => 100,
                            'message' => "Bạn không được sử dụng mã giảm giá này."
                        ];
                }
            } else {
                return $result;
            }
        }
    }
}
