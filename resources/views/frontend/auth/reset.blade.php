@extends('layouts.frontend')

@section('title','Quên mật khẩu')

@section('page-content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="row">
            <div class="col-sm-8">
                <img src="{{ $configs->banner_login ? route('image.resize',[$configs->banner_login,590,350]) : route('image.resize',['assets/frontend/images/no-image.png',590,350])}}" class="img-responsive">
            </div>
            <div class="col-sm-4">
                <div class="box-authentication">
                    <h3>Quên mật khẩu?</h3>
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
                    {!! Form::open(['url' => route('auth.send.password.email'), 'autocomplete'=>'off']) !!}
                        <label for="email">Địa chỉ Email</label>
                        {!! Form::email('email',null, ['class' => 'form-control','required']) !!}
                        <button class="button"><i class="fa fa-lock"></i> Gửi lại mật khẩu</button>
                    {!! Form::close() !!}
                    <hr>
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