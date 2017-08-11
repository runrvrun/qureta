<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')        
        @yield('addcss')
        @include('includes.wysiwyg_head')
        @include('includes.autocomplete_head')
    </head>
    <body>
        @include('includes.header')

        <div class="container content">
            <!--slider and banner-->
            <div class="row">                       
                <div class="col-md-2">
                    @include('includes.admin_sidebar')        
                </div>
                <div class="col-md-10">
                    @yield('content')                 
                </div>
            </div>        
        </div>        

        <footer class="footer" id="footertop">
            @include('includes.footer')    
            @yield('addjs')
            @include('includes.wysiwyg_footer')
        </footer>
    </body>
</html>
