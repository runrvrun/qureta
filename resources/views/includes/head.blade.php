<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Qureta - The Future of Reading">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
@yield('og')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Qureta @yield('title')</title>

<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/superfish.css') }}" media="screen"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/fontello/fontello.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flexslider.css') . '?v=' . filemtime('./css/flexslider.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/ui.css') . '?v=' . filemtime('./css/ui.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/base.css') . '?v=' . filemtime('./css/base.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') . '?v=' . filemtime('./css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/960.css') . '?v=' . filemtime('./css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/devices/1000.css') }}" media="only screen and (min-width: 768px) and (max-width: 1000px)" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/devices/767.css') }}" media="only screen and (min-width: 480px) and (max-width: 767px)" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/devices/479.css') . '?v=' . filemtime('./css/devices/479.css')}}" media="only screen and (min-width: 200px) and (max-width: 479px)" />
<link href='https://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!--[if lt IE 9]> <script type="text/javascript" src="js/customM.js"></script> <![endif]-->

<!-- Scripts -->
<script data-cfasync="false" type="text/javascript" src="{{ URL::asset('js/quretahead.js?v=201809181512') }}"></script>
<script data-cfasync='false'>
window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
</script>
<!-- shareaholic script -->
<script type='text/javascript' src='//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js' data-shr-siteid='b91b857ba0550d40b8b5b2368fa0fe13' async='async'></script>
<!-- google analytics -->
<script data-cfasync='false'>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69720429-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- jQuery di load di head karena dipakai di component (user_follow) -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
