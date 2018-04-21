@extends('layouts.frontend')

@section('title','Đăng nhập')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="col-sm-8">
                <img src="{{ $configs->banner_login ? route('image.resize',[$configs->banner_login,590,350]) : route('image.resize',['assets/frontend/images/no-image.png',590,350])}}" class="img-responsive">
            </div>
            <div class="col-sm-4">
                <div class="box-authentication">
                    <h3>Đăng nhập?</h3>
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
                    {!! Form::open(['url' => URL::current(), 'autocomplete'=>'off']) !!}
                        <label for="email">Địa chỉ Email</label>
                        {!! Form::email('email',null, ['class' => 'form-control','required']) !!}
                        <label for="password">Mật khẩu</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <p class="forgot-pass"><a href="{{route('auth.reset.password')}}">Quên mật khẩu?</a></p>
                        <button class="button"><i class="fa fa-lock"></i> Đăng nhập</button>
                    {!! Form::close() !!}
                    <hr>
                    {{--
                    <div class="social-link">
                        <span>Đăng nhập với:  </span>
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