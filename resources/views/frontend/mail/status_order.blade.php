<h2>Thay đổi trạng thái đơn hàng của bạn:</h2>
<b>Mã đơn hàng : #{{$data['code']}}</b>
<p>Họ tên: {{ !empty($data['name']) ? $data['name'] : $data['customer']['name'] }}</p>
<p>Số điện thoại: {{ !empty($data['phone']) ? $data['phone'] : $data['customer']['phone'] }}</p>
<p>Email: {{ !empty($data['email']) ? $data['email'] : $data['customer']['email'] }}</p>
@if (!empty($data['address']))
<p>Địa chỉ: {{$data['address']}}</p>
@endif
@if (!empty($data['note']))
<p>Nội dung: {{$data['note']}}</p>
@endif
<p>Thành tiền: {{number_format($data['total'] + $data['ship'])}} ₫</p>
<h3>Sản phẩm</h3>
@foreach($data['products'] as $product)
<p>
	<a target="_blank" href="{{route('product.show',$product['slug'])}}">
		<b>SP: #{{$product['code']}} - {{$product['name']}} </b>
	 	( {{number_format($product['pivot']['price'])}} ₫ x {{$product['pivot']['quantity']}} )
	</a>
</p>
@endforeach

<p>Thay đổi trạng thái từ <b>{{config("umzila.orderStatus.{$data['status']}.name")}}</b> sang <b>{{config("umzila.orderStatus.{$data['newStatus']}.name")}}</b></p>