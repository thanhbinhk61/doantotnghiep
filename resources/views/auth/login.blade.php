@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
       <!--  <div>
            <h1 class="logo-name">IN+</h1>
        </div> -->
        <h3>Welcome to Umzila</h3>
        @yield('content')
        <form class="m-t" role="form" method="POST" action="{{ URL::current() }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <!-- <a href="#"><small>Forgot password?</small></a> -->
            <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p> -->
        </form>
        <p class="m-t"> <small>Copyright 2016 Umzila Shop</small> </p>
    </div>
</div>

@endsection
