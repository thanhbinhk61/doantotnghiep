<?php

namespace App\Jobs\Order;

use App\Jobs\Job;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Eloquent\CouponCode;
use App\Eloquent\Address;
use App\Eloquent\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Services\Contracts\UserService;

class Payment extends Job
{
    protected $code;

    protected $orderId;

    protected $addressId;

    protected $cardId;

    public function __construct($code, $addressId, $orderId, $cardId)
    {
        $this->code = $code;
        $this->orderId = $orderId;
        $this->addressId = $addressId;
        $this->cardId = $cardId;
    }

    public function handle(OrderRepository $repository)
    {
        $dataSync = $this->dataCart();
        $dataCoupon = $this->useCoupon($dataSync['total'], $this->code);
        unset($dataSync['total']);
        if ($this->orderId) {
            $order = $repository->findOrFail($this->orderId);
            $repository->update($order, [
                    'total' => $dataCoupon['price'],
                    'coupon_id' => $dataCoupon['coupon_id'],
                    'status' => 2,
                    'cardId' => $this->cardId,
                    'code' => $this->generateCode()
                ]);
            $order->products()->sync($dataSync);
        } else {
            $customer = \Auth::guard('frontend')->user();
            $address = $this->addressCustomer($customer, $this->addressId);
            $order = $repository->create([
                            'total' => $dataCoupon['price'],
                            'coupon_id' => $dataCoupon['coupon_id'],
                            'status' => 2,
                            'ship' => $address->expense->price,
                            'expense_id' => $address->expense_id,
                            'address_id' => $this->addressId,
                            'customer_id' => $customer->id,
                            'cardId' => $this->cardId,
                            'code' => $this->generateCode()
                        ]);
            $order->products()->sync($dataSync);
        }
        $this->notification($order);
        return $order;
    }

    public function dataCart()
    {
        $results = [];
        $total = 0;
        foreach(\Cart::content() as $item) {
            $product = app(ProductRepository::class)->findOrFail($item->id);
            $price = $this->getPrice($product);
            $discount = $this->getDiscount($product);
            $changePrice = $this->getPriceProperty($product, $item->options->color_id, 'colors');
            foreach ($item->options->other_ids as $val) {
                $changePrice += $this->getPriceProperty($product, $val);
            }
            $color = $this->getNameProperty($product, $item->options->color_id, 'colors');
            $quantity = ($item->qty > $product->quantity) ? $product->quantity : $item->qty;
            $total += ($price + $changePrice) * $quantity;
            $results[$item->id] = [
                'quantity'  => $quantity,
                'price'     => $price + $changePrice,
                'color'     => $color,
                'other'     => implode(',', $item->options->other_ids),
                'provider_id' => $product->provider_id,
                'discount' => $discount
            ];
        }
        $results['total'] = $total;
        return $results;
    }

    public function getPrice(Model $product)
    {
        return ($product->sale == 1) ? $product->price : $product->price_sale;
    }

    public function getDiscount(Model $product)
    {
        $price = $this->getPrice($product);
        return ($product->discount_type == 1) ? $price * $product->discount_price/100 : $product->discount_price;
    }

    public function getPriceProperty(Model $product, $propertyId = 0, $type = 'others')
    {
        return ($propertyId == 0) ? 0 : $product->{$type}->keyBy('id')[$propertyId]['pivot']['price'];
    }

    public function getNameProperty(Model $product, $propertyId = 0, $type = 'others')
    {
        return ($propertyId == 0) ? '' : $product->{$type}->keyBy('id')[$propertyId]['name'];
    }

    public function notification(Model $order)
    {
        $url = parse_url(route('admin.order.show',$order->id), PHP_URL_PATH);
        $name = $order->name ? $order->name : $order->customer->name;
        $total = number_format($order->total + $order->ship);
        $text = "Có đơn hàng mới từ '{$name}' trị gía: {$total}";
        $sender = $order->id;
        $receiver = app(UserService::class)->getUserByRole(['id']);
        foreach ($receiver as $value) {
            app(Notification::class)->create([
                'name' => $name,
                'text' => $text,
                'sender_id' => $sender,
                'receiver_id' => $value->id,
                'icon' => 'fa-cart-plus',
                'url' => $url
            ]);
        }
    }

    public function useCoupon($price, $code = null)
    {
        $dataNull = [
            'price' => (int) $price,
            'coupon_id' => 0
        ];
        if ($code) {
            $coupon = app(CouponCode::class)->getCouponByCode($code);
            if ($coupon && $coupon->status == 1 && $coupon->expired_at >= Carbon::now() && $coupon->min <= $price) {
                $data['price'] = ($coupon->type == 1) ? $price * (100 - $coupon->value)/100 : $price - $coupon->value;
                $data['coupon_id'] = $coupon->id;
                if (!count($coupon->categories)) {
                    app(CouponCode::class)->deleteByCode($code);
                    return $data;
                } else {
                    if (\Auth::guard('frontend')->check() && isset(\Auth::guard('frontend')->user()->category->id) && isset($coupon->categories->keyBy('id')[\Auth::guard('frontend')->user()->category->id])) {
                        app(CouponCode::class)->deleteByCode($code);
                        return $data;
                    } else {
                        return $dataNull;
                    }
                }
            } else {
                return $dataNull;
            }
        } else {
            return $dataNull;
        }
    }

    public function addressCustomer(Model $customer, $addressId)
    {
        return isset($customer->addresses->keyBy('id')[$addressId]) ? $customer->addresses->keyBy('id')[$addressId] : $customer->addresses->first();
        
    }

    public function generateCode()
    {
        return app(OrderRepository::class)->generate();
    }

}
