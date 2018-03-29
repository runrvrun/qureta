@extends('layouts.app')
@section('addcss')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
@endsection
@section('content')
<div class="shop-slider">
    <div>
        <img src="{{ URL::asset('/images/shopslider1.jpg') }}" style="width:100%"/>
    </div>
    <div>
        <img src="{{ URL::asset('/images/shopslider2.jpg') }}" style="width:100%"/>
    </div>
</div>
<div class="row topic-title">
    <div class="col-sm-12">
        <h3><a href="https://www.ciptaloka.com/+qureta/kaos-2">KAOS</a></h3>
    </div>
</div>
<div class="row vertical-divider">
    @forelse ($shop as $key=>$row)
    <div class="article col-sm-3 grid-group-item">
        <!--Image-->
        <div class="article-image">
            <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
        </div>
        <!--Article-->
        <div class="article-info">
            <div class="title">{!! HTML::link($row->link, $row->name)!!}</div>
            <div class="info">Rp {{ number_format($row->price,0,',','.') }}</div>
        </div>
        <hr class="mobile-only" />
    </div>
    @if($key%4 == 3)
</div>
<hr>
<div class="row">
    @endif
    @empty
    @endforelse
</div>
@endsection
@section('addjs')
<script type="text/javascript" src="{{url::asset('/slick/slick.min.js')}}"></script>
<script>
$(document).ready(function (e) {
    $('.shop-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: true,
        swipe: true,
        dots: false,
        arrows: false,
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
@endsection
