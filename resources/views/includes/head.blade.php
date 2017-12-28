<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('og')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Qureta @yield('title')</title>

<!-- Styles -->
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="{{ URL::asset('/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ URL::asset('css/style.css') . '?v=' . filemtime('./css/style.css') }}" />

<!-- Scripts -->
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
