@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
<h2 class="page-title">{!! $pagetitle !!}</h2>
    @if($buqus->count() == 0)
	<br/><br/><p>Tidak ada hasil</p>
    @endif
    <div id="results">
    </div>
    <div class="ajax-loading"><img src="{{ asset('images/loading.gif') }}" /></div>
@endsection

@section('addjs')
<script>
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

    $('.btnLike').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = $this.data('postid');
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/buqu/like",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#EE5757'});
                }
            });
            $.ajax({
                url: "/buqu/incrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('.like-counter' + postid).html(parseInt($('.like-counter' + postid).html(), 10) + 1)
                }
            });
        } else {
            $.ajax({
                url: "/buqu/unlike",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#dedede'});
                }
            });
            $.ajax({
                url: "/buqu/decrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('.like-counter' + postid).html(parseInt($('.like-counter' + postid).html(), 10) - 1)
                }
            });
        }
    });
// share counter
    $('.share_button').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        $('.share' + postid).toggle();
        $('.shareaholic-share-button.ng-scope').css('display', 'block');
    });

    $('.share_button').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "id": postid};
        if (cookies_enabled()) {
            if ($.cookie("sharebuqu" + postid)) {
                // cookie exist, already count share, do nothing
            } else {
                // add share counter
                $.ajax({
                    url: "/buqu/incrementsharecounter",
                    type: "POST",
                    data: data,
                    error: function (exception) {
                        console.log(data)
                    },
                    success: function () {
                        $.cookie("sharebuqu" + postid, postid, {expires: 1});
                        $('.share-counter' + postid).html(parseInt($('.share-counter' + postid).html(), 10) + 1)
                    }
                });
            }
        }
    });
</script>
<script>
var page = 1; //track user scroll as page number, right now page number is 1
load_more(page); //initial content load
$(window).scroll(function() { //detect page scroll
    if($(window).scrollTop() + $(window).height() >= $(document).height()-170) { //if user scrolled from top to bottom of the page
        page++; //page number increment
        load_more(page); //load content
    }
});
function load_more(page){
  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            beforeSend: function()
            {
                $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);

                //notify user if nothing to load
                $('.ajax-loading').html("Tidak ada tulisan lagi");
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              //alert('No response from server');
        });
 }
</script>
@endsection
