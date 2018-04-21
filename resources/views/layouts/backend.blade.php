<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Dolphin Customer Management System">
    <meta name="author" content="Dolphin Technologies">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('head-append')
		@include('backend._partials.head')
	@show
</head>
<body class="skin-1">
    <div id="wrapper">
        @include('backend._partials.aside')
        <div id="page-wrapper" class="gray-bg">
        @include('backend._partials.header')
        @section('header-append')
        <div class="row wrapper border-bottom white-bg page-heading hidden-print">
            <div class="col-lg-10">
                <h2>{{{$heading or ''}}}</h2>
            </div>
        </div>
        @show
        @section('page-content')
        @show
        </div>
        @section('body-append')
            @include('backend._partials.foot')
        @show
    </div>
</body>
</html>