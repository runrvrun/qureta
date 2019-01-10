<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
  @include('includes.head')
<style>
body{
  background-color: #fff;
  margin: 0 auto;
  text-align: center;
  padding-top: 0px !important;
}
.btn-facebook {
    color: #fff;
    background-color: #3b5998;
    border-color: rgba(0,0,0,.2);
    width: 250px;
}
.btn-twitter {
    color: #fff;
    background-color: #55acee;
    border-color: rgba(0,0,0,.2);
    width: 250px;
}
.login-fb {
  margin: 20px 0 5px 0;
}
.login-tw {
  margin: 5px 0 20px;
}
.login-input .form-control {
  width: 267px;
}
</style>
<script>
function clearcookie(){
  document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
  console.log('cookie cleared');
  alert('Selesai clear browsing data. Silakan coba login kembali.');
}
</script>
</head>
<body>
    @if (Session::has('flash_message'))
    <div class="alert {!! Session::get('alert-type') !!} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
    @endif
    <!--div class="text-center alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>Qureta baru saja di update.</p>
        <p>Bila Anda kesulitan login, clear browsing data di browser Anda atau lakukan clear data di aplikasi anda.</p>
    </div-->
    <br/>
    <br/>
    <div>
        <a href="{{url('/')}}"> <img src="{{ URL::asset('/images/qureta-long-70.png') }}" style=""></a>
    </div>

    <div class="login-fb">
        <a class="btn btn-facebook" href="redirect/facebook">
            <i class="fab fa-facebook-f"></i> Login dengan Facebook
        </a>
    </div>
    <div class="login-tw">
        <a class="btn btn-social btn-twitter" style="" href="redirect/twitter">
            <i class="fab fa-twitter"></i> Login dengan Twitter
        </a>
    </div>
    <form role="form" method="POST" action="{{ url('/userlogin') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="">
            <div class="login-input">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="login-input" style="">
                <input id="password" type="password" class="form-control" placeholder="Password" name="password">

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="login-input">
                    <input type="checkbox" name="remember"> Ingat saya
                    <a class="btn btn-link" style="color:#252525; font-size: 13px;" href="{{ url('/password/reset') }}">
                        Lupa Password?
                    </a>
                    <a class="btn btn-link" style="color:#252525; font-size: 13px;" href="{{ url('/register') }}">
                        Daftar
                    </a>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="height: 40px; width:278px; margin:0;">
                Login
            </button>
        </div>
    </form>
    <div class="text-center">
        <a href="https://play.google.com/store/apps/details?id=com.quretamobile.Qureta"> <img width=120 src="{{ URL::asset('/images/google-play.jpg') }}" style=""></a>
    </div>
      @include('includes.foot')
</body>
</html>
