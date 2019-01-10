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
          @if(Auth::check())
          <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
          <input type="hidden" id="buquid" value="{{ $buqu->id }}" />
          @if(Auth::user()->id == $buqu->buqu_author || Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
          <div class="row pull-right">
              @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
              @if ($buqu->featured_at > 0)
              <span id="featuredbuqu" data-postid="{{ $buqu->id }}" class="active btn btn-warning btn-xs"><i class="fa fa-star"></i> Buqu Pilihan</span>
              @else
              <span id="featuredbuqu" data-postid="{{ $buqu->id }}" class="btn btn-default btn-xs"><i class="fa fa-star-o"></i> Buat Buqu Pilihan</span>
              @endif
              @endif
              <a href="{{ url('/buqus/'.$buqu->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit Buqu</a>
              {!! Form::open([
              'method'=>'DELETE',
              'url' => ['/buqus', $buqu->id],
              'style' => 'display:inline'
              ]) !!}
              {!! Form::button('<i class="fa fa-trash"></i> Hapus Buqu</div>', array(
              'type' => 'submit',
              'class' => 'btn btn-danger btn-xs',
              'title' => 'Delete Buqus',
              'onclick'=>'return confirm("Confirm delete?")'
              )) !!}
              {!! Form::close() !!}
              @endif
              @endif
          <h5 class="line"><span>{{ $pagetitle }}</span></h5>
            <div class="column-one-third">
              <div class="hide-on-mobile" style="width: 220px">
                @component('components.buqu',['row'=>$buqu])
                @endcomponent
              </div>
              <div class="hide-on-desktop">
                @component('components.buqu',['row'=>$buqu])
                @endcomponent
              </div>
            </div>
            <div class="column-one-third">
              <div class="outertight smimg">
                <ul class="block">
                  @forelse ($posts as $key=>$row)
                  <li>
                    @component('components.article_box_small', ['row' => $row])
                    @endcomponent
                  </li>
                  @empty
                  Belum ada artikel
                  @endforelse
                </ul>
              </div>
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
