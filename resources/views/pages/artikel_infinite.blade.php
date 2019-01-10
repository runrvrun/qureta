@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<!-- Adsense -->
<section id="adsensetop" style="margin-bottom:20px;">
    @component('components.adsense')
    @endcomponent
</section>
<!-- / Adsense -->
<!-- Content -->
<section id="content">
    <div class="container">
      <!-- Main Content -->
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span>{!! $pagetitle !!}</span></h5>
            @if(isset($pagesubtitle))
            <h6><span>{!! $pagesubtitle !!}</span></h6>
            @endif
            @if(count($posts))
            <ul class="block2">
                <div id="results"></div><div class="ajax-loading"><img src="{{ asset('images/loading.gif') }}" /></div>
            </ul>
            @else
             <br/><br/><h3>Tidak ada hasil</h3>
            @endif
          </div>
        </div>
        <!-- /Main Content -->
    </div>
</section>
<!-- / Content -->
<!-- Adsense -->
<section id="adsensebottom">
    @component('components.adsense')
    @endcomponent
</section>
<!-- / Adsense -->
@endsection
@section('addfooter')
<script>
var scrollTimer, lastScrollFireTime = 0;
var page = 1; //track user scroll as page number, right now page number is 1
load_more(page); //initial content load
$(window).scroll(function() { //detect page scroll
    var minScrollTime = 3000;
    var now = new Date().getTime();
    if($(window).scrollTop() + $(window).height() >= $(document).height()-170) { //if user scrolled from top to bottom of the page
      if (!scrollTimer) {
        if (now - lastScrollFireTime > (3 * minScrollTime)) {
          page++; //page number increment
          load_more(page); //load content
          lastScrollFireTime = now;
        }
        scrollTimer = setTimeout(function() {
              scrollTimer = null;
              lastScrollFireTime = new Date().getTime();
              page++; //page number increment
              load_more(page); //load content
        }, minScrollTime);
      }
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
