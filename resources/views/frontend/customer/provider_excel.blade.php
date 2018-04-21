<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    .table>thead>tr>th,
    .table>thead>tr>td {
        vertical-align: middle;
        text-align: center;
    }
</style>

<table id="provider-table" class="table table-bordered table-striped">
    <thead>
      	<tr>
	        <th >Mã </th>
	        <th >Sản phẩm</th>
	        <th >Đã bán</th>
	        <th >Còn lại</th>
	        <th >Giá</th>
	        <th >Chiết khấu</th>
	        <th>Còn lại</th>
      	</tr>
    </thead>

    <tbody>
        @foreach($items as $item)
        <?php 
            $dates = explode(' - ', $dateRange);
            $statisticCollect = $item->orderStatistic($dates[0], $dates[1], $dateGroup)->get();
        ?>
        @if (count($statisticCollect))
        <tr>
            <td>{{$item->code}}</td>
            <td>{{$item->name}}</td>
            <td>
                {{ $statisticCollect->sum(function ($order) {
                     return $order->pivot->quantity;
                }) }}
            </td>
            <td>{{$item->quantity}}</td>
            <td>
                {{ $statisticCollect->sum(function ($order) {
                        return $order->pivot->quantity * $order->pivot->price;
                    }) }}
            </td>
            <td class="hidden-xs ">
                {{ $statisticCollect->sum(function ($order) {
                        return $order->pivot->discount * $order->pivot->quantity;
                    }) }}
            </td>
            <td>
                {{ $statisticCollect->sum(function ($order) {
                        return ($order->pivot->price - $order->pivot->discount) * $order->pivot->quantity;
                    }) }}
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>