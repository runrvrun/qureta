@extends('layouts.sidebar')

@section('title')
- {!! $post->post_title !!}
@endsection

@section('content')
<?php Carbon::setLocale('id'); ?>
@if(!$post->hide_adsense)
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
<br>
@endif
@if( $post->post_status !== 'publish' )
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Post status: {{ $post->post_status }}
</div>
@endif

<div class="clearfix"></div>
@if(Auth::check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@if(Auth::user()->id == $post->post_author && $post->post_status === 'draft')
<div class="row pull-right"><a href="{{ url('/edit-tulisan/'.$post->post_slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit Tulisan</a></div>
@elseif ((Auth::user()->id == $post->post_author && (Auth::user()->role === 'premium' || Auth::user()->role === 'partner') || Auth::user()->role === 'admin' || Auth::user()->role === 'editor'))
<div class="row pull-right"><a href="{{ url('/edit-tulisan/'.$post->post_slug) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit Tulisan</a></div>
@endif
@endif
<div class="clearfix"></div>
<div class="user-info">
    @if(strpos($post->post_authors->user_image,'ttps://') || strpos($post->post_authors->user_image,'ttp://'))
    <div class="image"><img src="{{ $post->post_authors->user_image }}" alt="{{ $post->post_authors->user_image }}" onerror="avaError(this);" /></div>
    @else
    <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$post->post_authors->user_image) }}" alt="{{ $post->post_authors->user_image }}" onerror="avaError(this);" /></div>
    @endif
    <div class="name">
        {{ HTML::link('/profile/'.$post->post_authors->username, $post->post_authors->name)}}
@if(isset($post->post_authors->role) && ($post->post_authors->role == 'premium' || $post->post_authors->role == 'partner' || $post->post_authors->role == 'admin' || $post->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
            </div>
    <div class="title">{{ get_user_profesi($post->post_author) }}</div>
    <div class="info">{{ $post->published_at ? $post->published_at->format('j M Y'): '' }}</div>
	@if(Auth::check() && Auth::user()->role == 'admin')
    <div class="info">
	&middot; <i class="fa fa-eye"></i> Dibaca {{ number_format($post->view_count,0,',','.') }}{{ Counter::count('post', $post->id) }} kali
    </div>
	@endif
</div>
<div class="clearfix"></div>
<br>
<div class="row">
    <div class='shareaholic-canvas' data-link='{{ $post->post_slug }}' data-image="{{URL::asset('/uploads/post/'.$post->post_image)}}" data-app='share_buttons' data-app-id='26649626' data-summary='QURETA | {{$post->post_authors->name}}'></div>
</div>

<img class="article-featured-img" src="{{ URL::asset('/uploads/post/'.$post->post_image) }}" alt="{{ $post->post_image }}" onerror="imgError(this);" />
@if(!empty($post->post_image_credit))
<div class="post-image-credit"><small>{{ $post->post_image_credit }}</small></div>
@endif
<div class="article-single title">
    <div class="info"><small><i class="fa fa-tag"></i> {{ $category->category_title or '' }}</small>  &middot;  <small><i class="fa fa-clock-o"></i> {{read_time($post->post_content)}} menit baca</small></div>
    <h1>{!! $post->post_title !!} <small>{!! $post->post_subtitle ? '<br/>'.$post->post_subtitle : '' !!}</small></h1><input type="hidden" id="postid" value="{{ $post->id }}" />
</div>

<div class="article-single content @if(!Auth::check() && $post->require_login) require-login @endif">
    {!! $post->post_content !!}
</div>
    @if(!Auth::check() && $post->require_login)
	<div class="require-login-box well text-center">
	<p><strong>Daftar menjadi anggota Qureta untuk membaca tulisan eksklusif <br> {!! $post->post_title !!} karya {!! $post->post_authors->name !!}</strong></p>
	<a href="{{ url('/register') }}" class="btn btn-success btn-lg btn-block"> Daftar </a>
	<p><small>Sudah menjadi anggota Qureta? {{ HTML::link('/login','Log in') }}</small></p>
        </div>
    @endif
<hr/>

<div class="row">
        <div class='shareaholic-canvas' data-link='{{ $post->post_slug }}' data-image="{{URL::asset('/uploads/post/'.$post->post_image)}}" data-app='share_buttons' data-app-id='26649626'></div>
</div>
<div class="clearfix"></div>
<hr/>
<!-- author info -->
<!-- related article -->
@if(!$post->hide_adsense)
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
@endif
<!-- disqus comment -->
<div class="fb-comments" data-href="v3.qureta.com/post/{{ $post->post_slug }}" data-numposts="5"></div>
@endsection

@section('og')
<meta property="fb:app_id" content="1800357880247740" />
<meta property="og:url" content="{{ url('/post/'.$post->post_slug) }}" />
<meta property="og:title" content="{{ $post->post_title }}" />
<meta property="og:image" content="{{ URL::asset('/uploads/post/'.$post->post_image) }}" />
<meta property="og:image:width" content="640" />
<meta property="og:image:height" content="442" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ substr(strip_tags($post->post_content), 0, 500) }}">
<meta name="shareaholic:image" content="{{ URL::asset('/uploads/post/'.$post->post_image) }}" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ url('/post/'.$post->post_slug) }}">
<meta name="twitter:description" content="{{ substr(strip_tags($post->post_content), 0, 500) }}">
<meta name="twitter:text:description" content="{{ substr(strip_tags($post->post_content), 0, 500) }}">
<meta name="twitter:title" content="{{ $post->post_title }}">
<meta name="twitter:image" content="{{ URL::asset('/uploads/post/'.$post->post_image) }}" />
@endsection

@section('addjs')
<script type="text/javascript" src="{{URL::asset('/slick/slick.min.js')}}"></script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
 $(document).ready(function (e) {
    //froala inline image default center
    //have to do this in JS because there is no way to select parent in CSS
    $('.fr-dib').parent().css({
        'text-align' : 'center'
    });
});

    $(document).ready(function (e) {
        /** force crop thumbnails **/
        var articleimage = $('.article-image');
        var width = articleimage.width();
        articleimage.css('height', width * 157 / 262);
        var articleimage = $('.article-image.sidebar');
        var width = articleimage.width();
        articleimage.css('height', width * 157 / 262);
    });


    $('#btnLikePost').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = document.getElementById('postid').value;
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/post/like",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#EE5757'});
                }
            });
            $.ajax({
                url: "/post/incrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#like-counter').html(parseInt($('#like-counter').html(), 10) + 1)
                }
            });
        } else {
            $.ajax({
                url: "/post/unlike",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#dedede'});
                }
            });
            $.ajax({
                url: "/post/decrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#like-counter').html(parseInt($('#like-counter').html(), 10) - 1)
                }
            });
        }
    });

    $('#btnLikePost2').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = document.getElementById('postid').value;
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/post/like",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#EE5757'});
                }
            });
            $.ajax({
                url: "/post/incrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#like-counter2').html(parseInt($('#like-counter2').html(), 10) + 1)
                }
            });
        } else {
            $.ajax({
                url: "/post/unlike",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#dedede'});
                }
            });
            $.ajax({
                url: "/post/decrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#like-counter2').html(parseInt($('#like-counter2').html(), 10) - 1)
                }
            });
        }
    });

    $('#btnBookmarkPost').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = document.getElementById('postid').value;
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/post/bookmark",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#EE5757'});
                }
            });
        } else {
            $.ajax({
                url: "/post/unbookmark",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $(this).children("i").css({'color': '#dedede'});
                }
            });
        }
    });
</script>
@endsection
