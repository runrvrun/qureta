<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')  
        @yield('addcss')  
    </head>
    <body>
        @include('includes.header')

        <div class="container content">        
            <div class="row">       
                <div class="col-md-10 col-md-offset-1">
                    @yield('content')                 
                </div>
            </div>        
        </div>        

        <footer class="footer" id="footertop">
            @include('includes.footer')
            @yield('addjs')
        </footer>
    </body>
</html>
