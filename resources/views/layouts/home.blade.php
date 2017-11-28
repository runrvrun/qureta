<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')    
        @yield('addcss')
    </head>
    <body class="homepage">
        @include('includes.header')

        @yield('content')

        <footer class="footer" id="footertop">
            @include('includes.footer')
            @yield('addjs')
        </footer>

        <script type="text/javascript" src="slick/slick.min.js"></script>               
        <!--slider (slick)-->
        <script>
            $(document).ready(function (e) {
                $('.main-slider').slick({
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    pauseOnHover: true,
                    swipe: true,
                    arrows: true,
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
                $('.buqu-slider').slick({
                    infinite: true,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 10000,
                    pauseOnHover: true,
                    swipe: true,
                    arrows: true,
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        </script>      
    </body>
</html>
