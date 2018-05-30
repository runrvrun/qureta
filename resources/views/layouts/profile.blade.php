<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.header')

        <div class="container-fluid content profile-page">        
            <div class="row">
                <div>
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
