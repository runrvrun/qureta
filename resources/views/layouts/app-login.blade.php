<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>

    <body>
        <div class="container content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @yield('content')
                </div>
            </div>
        </div>
        <script data-cfasync="false" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>
</html>
