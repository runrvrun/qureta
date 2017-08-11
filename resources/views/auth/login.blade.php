@extends('layouts.app-login')

@section('content')
<div class="desktop-only" style="min-height:100px">
</div>
@if (Session::has('flash_message')) 
<div class="alert {!! Session::get('alert-type') !!} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
<div class="text-center logo-login">
    <a href="{{url('/')}}"> <img src="{{ URL::asset('/images/qureta-baru.png') }}" style=""></a>
</div>

<div class="row center-block text-center social-login login-facebook" style="">
    <a class="btn btn-social btn-facebook" style="" href="redirect/facebook">
        <i class="fa fa-facebook"></i>Login dengan Facebook
    </a>
</div>
<div class="row center-block text-center social-login login-twitter" style="">
    <a class="btn btn-social btn-twitter" style="" href="redirect/twitter">
        <i class="fa fa-twitter"></i>Login dengan Twitter
    </a>
</div>
<form class="form-horizontal" style="" role="form" method="POST" action="{{ url('/userlogin') }}">        
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="">
        <label for="email" class="col-md-4 control-label" style="color: white;"></label>

        <div class="row center-block text-center login-input" style="">
            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label" style="color: white;"></label>

        <div class="row center-block text-center login-input" style="">
            <input id="password" type="password" class="form-control" placeholder="Password" name="password">

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group" style="">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox login-input">
                <label style="color: #000;">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row center-block text-center button-login" style="">
            <button type="submit" class="btn btn-primary btn-block" style="height: 40px;">
                Login
            </button>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                Lupa Password?
            </a>
            <a class="btn btn-link" href="{{ url('/register') }}">
                Daftar
            </a>
        </div>
    </div>
</form>
@endsection
