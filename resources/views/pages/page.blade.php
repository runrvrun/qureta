@extends('layouts.app')

@section('content')
 <div class="row adsense-homepage-top">
        <script  data-cfasync="false" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Qresponsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9742758471829304"
             data-ad-slot="4756147752"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
<h1>{!! $page->post_title !!}</h1>
<div class="article-single content">
{!! $page->post_content !!}
</div>
 <div class="row adsense-homepage-bottom">
        <script  data-cfasync="false" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Qresponsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9742758471829304"
             data-ad-slot="4756147752"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endsection
