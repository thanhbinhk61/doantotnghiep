<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="header-top-right-wapper">
                    <div class="homeslider">
                        <ul id="contenhomeslider">
                            @foreach($slides as $slide)
                            <li><a href="{{$slide->link}}"><img alt="{{$slide->name}}" src="{{route('image.resize',[$slide->image,900,450])}}" title="{{$slide->name}}" /></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>