@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<!-- Adsense -->
<section id="adsensetop">
  @component('components.adsense')
  @endcomponent
</section>
<!-- / Adsense -->
<!-- Content -->
<section id="content">
    <div class="container">
      <h2 class="page-title">{!! $pagetitle !!} </h2>
      <!-- Main Content, Article Result -->
        <div class="main-content">
          <div class="column-two-third">
                <div class="outerwide">
                  <h5 class="line"><span>Tulisan</span></h5>
                  @if(count($posts))
                  <ul class="block2">
                      @for ($i = 0; $i < count($posts); $i++)
                        <?php $row = $posts[$i]; ?>
                        @if ($i%2)
                          <li class="m-r-no">
                            @component('components.article_box', ['row' => $row])
                            @endcomponent
                          </li>
                        @else
                          <li>
                            @component('components.article_box', ['row' => $row])
                            @endcomponent
                          </li>
                        @endif
                      @endfor
                  </ul>
                  @else
              	   <br/><br/><h3>Tidak ada hasil</h3>
                  @endif
                </div>
            </div>
        </div>
        <!-- /Main Content, Article Result -->
        <!-- Sidebar, User Result -->
        <div class="column-one-third">
          <div class="sidebar">
            <h5 class="line"><span>Penulis</span></h5>
              @if(count($users))
              <div id="tabs">
                <ul style="display:none;">
                    <li><a href="#tabs1">Penulis</a></li>
                </ul>
                <div id="tabs1" style="border:none;padding:0;">
                  <ul>
                      @foreach ($users as $key=>$row)
                      <li>
                        @component('components.user', ['row' => $row])
                        @endcomponent
                      </li>
                      @endforeach
                  </ul>
                </div>
              </div>
              @else
               <br/><br/><h3>Tidak ada hasil</h3>
              @endif
          </div>
        </div>
        <!-- / Sidebar, User Result -->
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
</script>
@endsection
