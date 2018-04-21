@extends('layouts.frontend')

@section('title',$category->title . ' | ' . $configs->title)
@section('description',$category->description)
@section('keywords',$category->keywords)


@section('page-content')

@include('frontend._partials.quickview')

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Về trang chủ">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            @if (count($category->parent))
            <a href="{{route('product.category',$category->parent->slug)}}" >{{$category->parent->name}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            @endif
            <span class="navigation_page">{{$category->name}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h2 class="page-heading">
                    <span class="page-heading-title2">{{$category->name}}</span>
                </h2>
                <div class="sortPagiBar clearfix">
                    <div class="bottom-pagination">
                        <nav>
                          {{$postCategory->render()}}
                        </nav>
                    </div>
                </div>
                <ul class="blog-posts">
                @foreach($postCategory as $post)
                    <li class="post-item">
                        <article class="entry">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="entry-thumb image-hover2">
                                        <a href="{{route('post.show',$post->slug)}}">
                                            <img src="{{route('image.resize',[$post->image,345,244])}}" alt="{{$post->name}}">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="entry-ci">
                                        <h3 class="entry-title"><a href="{{route('post.show',$post->slug)}}">{{$post->name}}</a></h3>
                                        <div class="entry-meta-data">
                                            
                                        </div>
                                        <div class="entry-excerpt">
                                            {{$post->intro}}
                                        </div>
                                        <div class="entry-more">
                                            <a href="{{route('post.show',$post->slug)}}">Xem tiếp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                @endforeach
                </ul>
                <div class="sortPagiBar clearfix">
                    <div class="bottom-pagination">
                        <nav>
                          {{$postCategory->render()}}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->

            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">Danh mục</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">
                                    @foreach($categoryPost as $cateRoot)
                                    <li class="@if(count($cateRoot->children) > 0) active @endif ">
                                        <span></span><a href="{{route('post.category',$cateRoot->slug)}}">{{$cateRoot->name}}</a>
                                        @if (count($cateRoot->children) > 0)
                                        <ul>
                                            @foreach ($cateRoot->children as $children)
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
        <!-- ./row-->
    </div>
</div>
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