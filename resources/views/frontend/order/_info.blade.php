<div class="block left-module">
    <p class="title_block">Thông tin đơn hàng</p>
    <div class="block_content">
        <table width="100%" class="cart_totals">
            <tr class="cart-subtotal">
                <th>Tổng số lượng</th>
                <td><span class="amount quantity-checkout">{{number_format(Cart::count())}} </span></td>
            </tr>
            <tr class="cart-subtotal">
                <th>Tạm tính</th>
                <td><span class="amount total-checkout">{{number_format(Cart::total())}} ₫</span></td>
            </tr>

            @if (isset($coupon))
            <tr class="code-coupon">
                <th>Giảm giá</th>
                <td><span class="amount">- {{number_format($coupon->value)}} {{ ($coupon->type == 1) ? '%' : '₫'}} </span></td>
            </tr>

            <?php
                $totalCoupon = ($coupon->type == 1) ? Cart::total() * (100 - $coupon->value)/100 : Cart::total() - $coupon->value;
            ?>
            <tr class="code-coupon">
                <th>Thành tiền</th>
                <td><span class="amount">{{ number_format($totalCoupon) }} ₫ </span></td>
            </tr>
            @endif

            <?php 
                if ($me) {
                    $shipPrice = isset($addressCustomer) ? $addressCustomer->expense->price : 0;
                } else {
                    $shipPrice = isset($order) ? $order->ship : 0;
                }
            ?>
            <tr class="shipping">
                <th>Phí vận chuyển</th>
                <td><span class="amount shipping-price">{{ number_format($shipPrice) }} ₫</span></td>
            </tr>

            <?php 
                $totalFinal = isset($totalCoupon) ? $totalCoupon + $shipPrice : Cart::total() + $shipPrice;
            ?>
            <tr class="order-total">
                <th>Thanh toán</th>
                <td><strong><span class="amount product-price total-order"> {{ number_format($totalFinal)}} ₫</span></strong></td>
            </tr>
        </table>
    </div>
</div>