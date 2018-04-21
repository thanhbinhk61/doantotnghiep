@extends('layouts.frontend')

@section('page-content')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Nhà cung cấp</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">                
               @include('frontend._partials.sale')
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div class="row-brand">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Nhà cung cấp</span> 
                    </h2>
                    <div class="band-logo">
                        <div class="row">
                        @foreach ($providers as $provider)
                            <div class="col-sm-3 text-center" style=>
                                <a href="{{route('product.provider',$provider->slug)}}">
                                    <img class="img-thumbnail lazy" data-original="{{ $provider->logo ? route('image.resize',[$provider->logo,250,115]) : route('image.resize',['assets/frontend/images/1.jpg',250,115])}}" alt="{{$provider->name}}">
                                </a>
                                <p class="brand-name"><a href="{{route('product.provider',$provider->slug)}}">{{$provider->name}}</a></p>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                        {{$providers->render()}}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
@include('frontend._partials.viewed')
@endsection

@section('body-append')
    @parent
    {!! HTML::script('assets/frontend/lib/jquery-ui/jquery-ui.min.js') !!}
    {{ HTML::script('assets/backend/js/laroute.js') }}
    <script type="text/javascript">
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");
        });
    </script>
@endsection