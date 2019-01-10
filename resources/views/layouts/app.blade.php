<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

    <head>
        @include('includes.head')
        @yield('addhead')
        @yield('og')
    </head>
    <body>
        <!-- Body Wrapper -->
        <div class="body-wrapper">
        	<div class="controller">
            <div class="controller2">
                    <span class="hide-on-mobile">@include('includes.header')</span>
                    <span class="hide-on-desktop">@include('includes.headerm')</span>
                    <p class="hide-on-desktop" style="clear:both;padding-top:50px;"></p>
                    @yield('content')
                    @include('includes.footer')
          </div>
      	</div>
      </div>
      <!-- / Body Wrapper -->
        @include('includes.foot')
        @yield('addfooter')
    </body>
</html>
