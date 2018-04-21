@extends('layouts.frontend')

@section('title',$item->title . ' | ' . $configs->title)
@section('description',$item->description)
@section('keywords',$item->keywords)

@section('head-append')
@parent
    <meta property="og:type" content="post.item" />
    <meta property="og:description" content="Bài viết {{$item->description}}" />
    <meta property="og:image" content="{{$item->image}}" />
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
            @if (count($item->categoryRoot))
            <a href="{{route('post.category',$item->categoryRoot->first()->slug)}}" >{{$item->categoryRoot->first()->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            @endif
            @if(count($item->categoryChildren))
            <a href="{{route('post.category',$item->categoryChildren->first()->slug)}}" >{{$item->categoryChildren->first()->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            @endif
            <span class="navigation_page">{{$item->name}}</span>
        </div>
        <div class="row">
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">{{$item->name}}</span>
                </h1>
                <article class="entry-detail">
                    <div class="entry-meta-data">
                        <span class="cat">
                            <i class="fa fa-folder-o"></i>
                            @foreach($item->categories as $category)
                            <a href="{{route('post.category',$category->slug)}}">{{$category->name}}</a>
                            @endforeach
                        </span>
                    </div>
                    <div class="content-text clearfix">
                        <p>{!!$item->content!!}</p>
                    </div>
                    <div class="entry-tags">
                        <span>Từ khóa:</span>
                        <span style="color:#666">{{$item->tags}}</span>
                    </div>
                </article>
                <!-- Related Posts -->
                <div class="single-box">
                    <h2>Bài viết liên quan</h2>
                    <ul class="related-posts owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                        @foreach($postSame as $same)
                        <li class="post-item">
                            <article class="entry">
                                <div class="entry-thumb image-hover2">
                                    <a href="{{route('post.show',$same->slug)}}">
                                        <img src="{{route('image.resize',[$same->image,345,244])}}" alt="{{$same->name}}">
                                    </a>
                                </div>
                                <div class="entry-ci">
                                    <h3 class="entry-title"><a href="{{route('post.show',$same->slug)}}">{{$same->name}}</a></h3>
                                    <div class="entry-meta-data">
                                        
                                    </div>
                                    <div class="entry-more">
                                        <a href="{{route('post.show',$same->slug)}}">Xem tiếp</a>
                                    </div>
                                </div>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- ./Related Posts -->
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