<h2>Thông tin về sản phẩm order của bạn:</h2>
@if (!empty($data['info']))
@foreach(json_decode($data['info']) as $infoJson)
<p><b>Link sản phẩm : <a href="{{$infoJson->link}}">Link</a> </b> - {{$infoJson->description}}</p>
@endforeach
@endif
<p>Họ tên: {{ !empty($data['name']) ? $data['name'] : $data['customer']['name'] }}</p>
<p>Số điện thoại: {{ !empty($data['phone']) ? $data['phone'] : $data['customer']['phone'] }}</p>
<p>Địa chỉ: {{ !empty($data['address']) ? $data['address'] : $data['customer']['address'] }}</p>

@if (!empty($data['note']))
<p>Nội dung: {{$data['note']}}</p>
@endif

<p>Báo giá: {{number_format($data['total'])}} ₫</p>

<p>{!! $data['reply'] !!}</p>