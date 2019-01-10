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
          <h5 class="line"><span>{{ $pagetitle }}</span></h5>
          @forelse ($buqus as $key=>$row)
            <div class="column-one-fourth">
                @component('components.buqu',['row'=>$row])
                @endcomponent
            </div>
          @empty
          Tidak ada hasil
          @endforelse
        </div>
        @if (method_exists($buqus,'render') && $buqus->lastPage()>1)
          @if(isset($querystring['sp']) && isset($querystring['q']))
            <div class="pagination-wrapper"> {!! $buqus->appends(['sp' => $querystring['sp'],'q' => $querystring['q']])->render() !!} </div>
          @else
            <div class="pagination-wrapper"> {!! $buqus->render() !!} </div>
          @endif
        @endif
        </div>
        <!-- /Main Content -->
    </div>
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
