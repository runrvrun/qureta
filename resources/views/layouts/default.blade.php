<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')    
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
        </footer>

        <!-- Scripts -->
        <script src="/js/app.js"></script>
        <!--script type="text/javascript" src="/jquery/jquery.min.js"></script-->
        <!--script type="text/javascript" src="/jquery/jquery-migrate.min.js"></script-->
        <script type="text/javascript" src="slick/slick.min.js"></script>
        <!--replace error image-->
        <script>
            function imgError(image) {
                image.onerror = "";
                image.src = "/uploads/noimage.jpg";
                return true;
            }
            function avaError(image) {
                image.onerror = "";
                image.src = "/uploads/avatar/noavatar.jpg";
                return true;
            }
            function buquError(image) {
                image.onerror = "";
                image.src = "/uploads/buqu/nocover.jpg";
                return true;
            }
        </script>
        <!--filter search bar-->
        <script>
            $(document).ready(function (e) {
                $('.search-panel .dropdown-menu').find('a').click(function (e) {
                    e.preventDefault();
                    var param = $(this).attr("href").replace("#", "");
                    //var concept = $(this).text();
                    var concept = $(this).find('span').attr('class');
                    //$('.search-panel span#search_concept').text(concept);
                    $('.search-panel span#search_concept_icon').removeClass();
                    $('.search-panel span#search_concept_icon').addClass(concept);
                    $('.input-group #search_param').val(param);
                });

                $('.main-slider').slick({
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 10000,
                    arrows: true,
                    swipe: true,
                    pauseOnHover: true
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
        <!--switch list grid view-->
        <script>
            $(document).ready(function () {
                $('#list').click(function (event) {
                    event.preventDefault();
                    $('.article').removeClass('grid-group-item').addClass('list-group-item');
                    $('.vertical-divider').addClass('no-vertical-divider').removeClass('vertical-divider');
                    $('.article-image:parent').each(function () {
                        $(this).insertBefore($(this).prev('.user-info'));
                    });
                    $('.article-info .title:parent').each(function () {
                        $(this).insertBefore($(this).prev('.article-info .info'));
                    });
                });
                $('#grid').click(function (event) {
                    event.preventDefault();
                    $('.article').removeClass('list-group-item').addClass('grid-group-item');
                    $('.no-vertical-divider').addClass('vertical-divider').removeClass('no-vertical-divider');
                    $('.user-info:parent').each(function () {
                        $(this).insertBefore($(this).prev('.article-image'));
                    });
                    $('.article-info .info:parent').each(function () {
                        $(this).insertBefore($(this).prev('.article-info .title'));
                    });
                });
            });
            
            
            //show header on scroll up
            var didScroll;
            var lastScrollTop = 0;
            var delta = 5;
            var navbarHeight = $('#main-menu').outerHeight();

            $(window).scroll(function (event) {
                didScroll = true;
            });

            setInterval(function () {
                if (didScroll) {
                    hasScrolled();
                    didScroll = false;
                }
            }, 250);

            function hasScrolled() {
                var st = $(this).scrollTop();

                // Make sure they scroll more than delta
                if (Math.abs(lastScrollTop - st) <= delta)
                    return;

                // If they scrolled down and are past the navbar, add class .nav-up.
                // This is necessary so you never see what is "behind" the navbar.
                if (st > lastScrollTop && st > navbarHeight) {
                    // Scroll Down
                    $('#main-menu').removeClass('nav-down').addClass('nav-up');
                } else {
                    // Scroll Up
                    if (st + $(window).height() < $(document).height()) {
                        $('#main-menu').removeClass('nav-up').addClass('nav-down');
                    }
                }

                lastScrollTop = st;
            }
            
        </script>
    </body>
</html>
