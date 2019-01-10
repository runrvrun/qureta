<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.includes.head')
        @yield('addhead')
    </head>
    <body>
        @include('admin.includes.header')

        <div class="container content">
            <!--slider and banner-->
            <div class="row">
                <div class="col-md-2">
                  @include('admin.includes.admin_sidebar')
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            @include('admin.includes.foot')
            @yield('addfooter')
        </footer>
    </body>
</html>
