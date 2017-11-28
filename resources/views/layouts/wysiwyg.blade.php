<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')        
        @include('includes.wysiwyg_head')
        @yield('addcss')
    </head>
    <body>
        @include('includes.header')

        <div class="container content">
            <!--slider and banner-->
            <div class="row">       
                <div class="col-md-12">
                    @yield('content')                 
                </div>
            </div>        
        </div>        

        <footer class="footer" id="footertop">
            @include('includes.footer')
            @include('includes.wysiwyg_footer')
            @yield('addjs')
        </footer>
    </body>
</html>
