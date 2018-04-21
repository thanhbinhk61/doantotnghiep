@extends('layouts.frontend')

@section('title','Đăng ký')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="col-sm-8">
                <img src="{{ $configs->banner_login ? route('image.resize',[$configs->banner_login,590,350]) : route('image.resize',['assets/frontend/images/no-image.png',590,350])}}" class="img-responsive">
            </div>
            <div class="col-sm-4">
                <div class="box-authentication">
                    <h3>Đăng ký ?</h3>
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Lỗi:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {!! Form::open(['url' => route('auth.store'), 'autocomplete'=>'off']) !!}
                        <label for="name">Tên *</label>
                        {!! Form::text('name',null, ['class' => 'form-control','required']) !!}
                        <label for="email">Email *</label>
                        {!! Form::email('email',null, ['class' => 'form-control','required']) !!}
                        <label for="password">Mật khẩu *</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <label for="password_confirmation">Nhập lại mật khẩu *</label>
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        <button class="button"><i class="fa fa-lock"></i> Đăng ký</button>

                    {!! Form::close() !!}
                    <hr>
                    {{--
                    <div class="social-link">
                        <span>Đăng ký với:  </span>
                        <a href="{{route('auth.social','facebook')}}"><i class="fa fa-facebook"></i></a>
                        <a href="{{route('auth.social','google')}}"><i class="fa fa-google-plus"></i></a> 
                    </div>
                    --}}
                </div>
            </div>
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