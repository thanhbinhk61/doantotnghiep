@if (Cookie::get('itemViewed'))
<?php 
    //$itemViewed = array_reverse(array_slice(Cookie::get('itemViewed'), 0, 8);
    $itemViewed = array_reverse(Cookie::get('itemViewed'));
    $itemViewed = array_slice($itemViewed, 0,8);
    //dd($itemViewed);
?>
<div class="container">
    <div class="row-brand">
        <h2 class="page-heading">
            <span class="page-heading-title">Sản phẩm đã xem</span>
        </h2>
        <ul class="band-logo owl-carousel"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "15" data-responsive='{"0":{"items":3},"600":{"items":5},"1000":{"items":8}}'>
            @foreach($itemViewed as $viewed)
            <li>
                <a title="{{ isset($viewed['name']) ? $viewed['name'] : ' ' }}" href="{{ isset($viewed['slug']) ? route('product.show',$viewed['slug']) : '#'  }}">
                    <img src="{{ isset($viewed['image']) ? route('image.resize',[$viewed['image'],145,145]) : route('image.resize',['assets/frontend/images/no-image.png',145,145])}}">
                </a>
            </li>
            @endforeach           
        </ul>
    </div>
</div>
@endif