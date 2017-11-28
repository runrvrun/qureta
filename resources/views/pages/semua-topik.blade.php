@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<?php Carbon::setLocale('id'); ?>
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
@if (isset($_SESSION['flash_message']))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{{ Session::get('flash_message') }}</p>
</div>
@endif
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
<h2 class="page-title">{!! $pagetitle !!} </h2>
<!--select view-->
<div class="row">
    <div class="col-md-12 select-view">       
        <div class="btn-group" role="group">
            <button  type="button" id="grid" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button>
            <button  type="button" id="list" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button>                
        </div>
    </div>
</div>
<hr class="rowspace">
    
<div class="row vertical-divider">
    @foreach ($categories as $key=>$row)                       
    <div class="article col-sm-3 grid-group-item">        
        <!--Author-->
        
        <!--Image-->
        <div class="article-image">
            <a href="{{ url('/topik/'.$row->category_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
        </div>       
        <!--Article-->
        <div class="article-info">                
            <div class="title"> {{ HTML::link('/topik/'.$row->category_slug, $row->category_title)}}</div>
        </div>
       <!--Share Like Buqu-->
               
    </div>  
        
    @if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row vertical-divider">
    @endif
    @endforeach    
</div>
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
@endsection
@section('addjs')

<script>
$(document).ready(function (e) {
    /** force crop thumbnails **/
    var articleimage = $('.article-image');
    var width = articleimage.width();
    articleimage.css('height', width * 157 / 262);
    var articleimage = $('.article-image.sidebar');
    var width = articleimage.width();
    articleimage.css('height', width * 157 / 262);
});

</script>
@endsection