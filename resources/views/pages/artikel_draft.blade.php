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
            <ul class="block2">
                @forelse($posts as $key=>$row)
                  <li>
                    @component('components.article_box',['row'=>$row])
                    @endcomponent
                  </li>
                @empty
                  Belum ada tulisan
                @endforelse
            </ul>
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
@endsection
