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
          @forelse ($categories as $key=>$row)
            <div class="column-one-fourth">
              <!-- buqu component -->
              <div class="buqu-info">
                <a href="{{ url('/topik/'.$row->category_slug) }}">
                  <div class="buqu-image" style="background-image: url('{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}'), url('{{ URL::asset('images/noimage.jpg') }}');"></div>
                </a>
                <div class="buqu-info-float buqu-title">
                    {{ HTML::link('/topik/'.$row->category_slug, $row->category_title)}}
                </div>
              </div>
              <!-- / buqu component -->
            </div>
          @empty
          Tidak ada hasil
          @endforelse
        </div>
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
