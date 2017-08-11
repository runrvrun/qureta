<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')        
        @yield('addcss')  
        @include('includes.wysiwyg_head')
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
