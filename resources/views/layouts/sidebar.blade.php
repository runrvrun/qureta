<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')    
    </head>
    <body>
        @include('includes.header')

        <div class="container content">
            <!--slider and banner-->
            <div class="row">       
                <div class="col-md-7 col-md-offset-1">
                    @yield('content')                 
                </div>
                <div class="col-md-4 sidebar">
                    @include('includes.sidebar')        
                </div>
            </div>        
        </div>        

        <footer class="footer" id="footertop">
            @include('includes.footer')
            @yield('addjs')
        </footer>
    </body>
</html>
