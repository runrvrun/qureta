function imgError(image) {
    image.onerror = "";
    image.src = "/uploads/post/thumb/noimage.jpg";
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

$(document).ready(function (e) {
    /** filter search bar **/
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
    /** switch grid view-list view **/
    $('#list').click(function (event) {
        event.preventDefault();
        $('.article').removeClass('grid-group-item').addClass('list-group-item');
        $('.row-divider').addClass('displaynone');
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
        $('.row-divider').removeClass('displaynone');
        $('.no-vertical-divider').addClass('vertical-divider').removeClass('no-vertical-divider');
        $('.user-info:parent').each(function () {
            $(this).insertBefore($(this).prev('.article-image'));
        });
        $('.article-info .info:parent').each(function () {
            $(this).insertBefore($(this).prev('.article-info .title'));
        });
    });

    /* notification mark as read*/
    $('#notif-button').click(function (event) {
        var $this = $(this);
        var userid = $this.data('userid');
        var token = $this.data('csrf_token');
        var data = {"_token": token, "userid": userid};
        // add share counter
        $.ajax({
            url: "/user/marknotifasread",
            type: "POST",
            data: data,
            error: function (exception) {
                console.log(data)
            },
            success: function () {
            }
        });
    });
});


/** show header on scroll up **/
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
    if (Math.abs(lastScrollTop - st) <= delta){
        return;
      }

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

function cookies_enabled()
{
    var cookieEnabled = (navigator.cookieEnabled) ? true : false;

    if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
    {
        document.cookie = "testcookie";
        cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
    }
    return (cookieEnabled);
}
