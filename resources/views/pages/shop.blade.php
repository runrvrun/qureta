@extends('layouts.app')

@section('title')
- Shop
@endsection
@section('addhead')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
<style>
.shop img{
  max-width:100%;
}
.shop .product-name{
  text-align: center;
  font-size: 16px;
}
.shop .product-name a{
  color: #252525;
}
.shop .product-price{
  text-align: center;
  font-size: 18px;
  border-radius: 3px;
  background-color: #333;
  color: #fff;
}
</style>
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
    <div class="container shop">
      <!-- Main Content -->
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span>Qureta Shop</span></h5>
            <div class="shop-slider">
                <div>
                    <img src="{{ URL::asset('/images/shopslider1.jpg') }}" style="width:100%; max-width:100%;"/>
                </div>
                <div>
                    <img src="{{ URL::asset('/images/shopslider2.jpg') }}" style="width:100%; max-width:100%;"/>
                </div>
            </div>
          </div>
        </div>

        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span><a href="https://www.ciptaloka.com/+qureta/kaos-2">Kaos</a></span></h5>
            @forelse ($kaos as $key=>$row)
            <div class="column-one-fourth">
            <div class="">
                <!--Image-->
                <div class="">
                    <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
                </div>
                <!--Article-->
                <div class="">
                    <div class="product-price">Rp {{ number_format($row->price,0,',','.') }}</div>
                    <div class="product-name">{!! HTML::link($row->link, $row->name)!!}</div>
                </div>
            </div>
            </div>
            @empty
            Tidak ada produk
            @endforelse
            <div style="margin-top:7px; text-align:right;"><a href="https://www.ciptaloka.com/+qureta/kaos-2">Lihat produk lainnya &raquo;</a></div>
          </div>
        </div>

        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span><a href="https://www.ciptaloka.com/+qureta/mug-17">Mug</a></span></h5>
            @forelse ($mug as $key=>$row)
            <div class="column-one-fourth">
            <div class="">
                <!--Image-->
                <div class="">
                    <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
                </div>
                <!--Article-->
                <div class="">
                    <div class="product-price">Rp {{ number_format($row->price,0,',','.') }}</div>
                    <div class="product-name">{!! HTML::link($row->link, $row->name)!!}</div>
                </div>
            </div>
            </div>
            @empty
            Tidak ada produk
            @endforelse
            <div style="margin-top:7px; text-align:right;"><a href="https://www.ciptaloka.com/+qureta/mug-17">Lihat produk lainnya &raquo;</a></div>
          </div>
        </div>
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span><a href="https://www.ciptaloka.com/+qureta/tas_dan_dompet-18">Tas</a></span></h5>
            @forelse ($tas as $key=>$row)
            <div class="column-one-fourth">
            <div class="">
                <!--Image-->
                <div class="">
                    <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
                </div>
                <!--Article-->
                <div class="">
                    <div class="product-price">Rp {{ number_format($row->price,0,',','.') }}</div>
                    <div class="product-name">{!! HTML::link($row->link, $row->name)!!}</div>
                </div>
            </div>
            </div>
            @empty
            Tidak ada produk
            @endforelse
            <div style="margin-top:7px; text-align:right;"><a href="https://www.ciptaloka.com/+qureta/tas_dan_dompet-18">Lihat produk lainnya &raquo;</a></div>
          </div>
        </div>
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span><a href="https://www.ciptaloka.com/+qureta/bantal_sofa-16">Bantal</a></span></h5>
            @forelse ($bantal as $key=>$row)
            <div class="column-one-fourth">
            <div class="">
                <!--Image-->
                <div class="">
                    <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
                </div>
                <!--Article-->
                <div class="">
                    <div class="product-price">Rp {{ number_format($row->price,0,',','.') }}</div>
                    <div class="product-name">{!! HTML::link($row->link, $row->name)!!}</div>
                </div>
            </div>
            </div>
            @empty
            Tidak ada produk
            @endforelse
            <div style="margin-top:7px; text-align:right;"><a href="https://www.ciptaloka.com/+qureta/bantal_sofa-16">Lihat produk lainnya &raquo;</a></div>
          </div>
        </div>
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span><a href="https://www.ciptaloka.com/+qureta">Lainnya</a></span></h5>
            @forelse ($lainnya as $key=>$row)
            <div class="column-one-fourth">
            <div class="">
                <!--Image-->
                <div class="">
                    <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
                </div>
                <!--Article-->
                <div class="">
                    <div class="product-price">Rp {{ number_format($row->price,0,',','.') }}</div>
                    <div class="product-name">{!! HTML::link($row->link, $row->name)!!}</div>
                </div>
            </div>
            </div>
            @empty
            Tidak ada produk
            @endforelse
            <div style="margin-top:7px; text-align:right;"><a href="https://www.ciptaloka.com/+qureta">Lihat produk lainnya &raquo;</a></div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('addfooter')
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
