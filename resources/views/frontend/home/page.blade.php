@extends('layouts.frontend')

@section('title',$item->title . ' | ' . $configs->title)
@section('description',$item->description)
@section('keywords',$item->keywords)

@section('head-append')
@parent
    <meta property="og:type" content="page.item" />
    <meta property="og:description" content="Bài viết {{$item->description}}" />
    <meta property="post:retailer_item_id" content="{{$item->id}}" />
    <meta property="post:availability" content="available for order" />
    <meta property="post:condition" content="new" />
@endsection

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">{{$item->name}}</span>
        </div>
        <div class="row">
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">{{$item->name}}</span>
                </h1>
                <article class="entry-detail">
                    <div class="content-text clearfix">
                        <p>{!!$item->content!!}</p>
                    </div>
                </article>
            </div>
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    @foreach($categoryPost as $catePost)
                                    <li class="@if(count($catePost->children) > 0) active @endif ">
                                        <span></span><a href="{{route('post.category',$catePost->slug)}}">{{$catePost->name}}</a>
                                        @if (count($catePost->children) > 0)
                                        <ul>
                                            @foreach ($catePost->children as $children)
                                            <li><span></span><a href="{{route('post.category',$children->slug)}}">{{$children->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                
               @include('frontend._partials.sale')
            </div>
            <!-- ./right colunm -->
        </div>
    </div>
</div>
@endsection

@section('body-append')
    @parent
    <script>
        $(function (){
            $('body').removeClass('home');
            $('.columns-container').css("background","#fff");

        });
    </script>
@endsection