@extends('layouts.home')

@section('title')
@endsection

@section('content')
@if (Session::has('flash_message'))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
<?php Carbon::setLocale('id'); ?>
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif

<div class="container" style="">
    <!--slider and banner-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/buqu', 'BUQU')}}</h3>
        </div>
    </div>
    <div class="row">          
                      
        <div class="buqu-slider" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
         @foreach ($buqus as $row)
        <div class="col-sm-3 grid-group-item">            
            <!--Author-->
            <br>
            
                <div class="panel panel-default">
                    <div class="" >                        
                        <!--Buqu-->
                      <div class="buqu-info" style="width:100%;position: relative;">
                            <a href="{{ url('/buqu/'.$row->buqu_slug) }}"><img class="img-slider" style="width:100%;display: none;max-height:100%; max-width:100%;" src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" onerror="buquError(this);" /></a>                            
                            <div class="col-md-12 title" style="position: absolute;width:100%;height: 100%;top:0;margin: 0 auto;">
                                <div class="col-md-12 penulis" style="position: absolute; top:5%;text-align: center;margin: 0 auto;;width: 100%;font-size: 15px; text-shadow: 2px 2px 4px #000000;">
                                    {{ HTML::link('/profile/'.$row->buqu_authors->username, $row->buqu_authors->name)}}
                                </div>
                                 <div class="col-md-12 judul" style="position: absolute; bottom:10%; text-shadow: 2px 2px 4px #000000;">
                                {{ HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_title)}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
             @endforeach   
            <!--Article-->
        </div>
       
    </div>
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
<!--adsense-->
<div class="desktop-only" style="text-align:center; margin: 20px 0 -20px 0;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Qureta v3 homepage top -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:90px"
         data-ad-client="ca-pub-9742758471829304"
         data-ad-slot="9045264552"></ins>
    <script>
(adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<div class="mobile-only">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Qureta v3 sidebar article ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9742758471829304"
     data-ad-slot="6451724954"
     data-ad-format="horizontal"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!--end adsense-->
    <!--topic row 1-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/aktual', 'AKTUAL')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($aktual as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br>
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div>    
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='{{ $row->post_title }} | Qureta' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
     <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--topic row 2-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/inspiratif', 'INSPIRATIF')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($inspiratif as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div>   
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
@endforeach
    </div>
     <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--topic row 3-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/jenaka', 'JENAKA')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($jenaka as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div>            
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
     <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--topic row 4-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/kiat', 'KIAT')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($kiat as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div> 
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
     <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--topic row 5-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/fiksi', 'FIKSI')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($fiksi as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div>         
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
     <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('post/populer', 'TERPOPULER')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">          
        @foreach ($posts as $key=>$row)
        @if($key<4)                
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" onerror="avaError(this);" /></div>
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                @if(Auth::check()) 
                @if (isLiking($row->id))
                <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @else
                <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                @endif
                @else                
                <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                @endif
                <span class="action-button"><a href="{{ url('/buqu_posts/create/'.$row->id) }}"><i class="fa fa-book"></i> {{ get_post_buqu_count($row->id) }}</a></span>
            </div>         
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
</div>
@endsection
@section('addjs')
<script type="text/javascript" src="slick/slick.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>


$(document).ready(function() {
    $('.img-slider').show();
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

$('.share_button').click(function () {
    var $this = $(this);
    var postid = $this.data('postid');
    $('.share' + postid).toggle();
    $('.shareaholic-share-button.ng-scope').css('display', 'block');
});
$('.btnLike').click(function () {
    var $this = $(this);
    $this.toggleClass('active');
    var postid = $this.data('postid');
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
                $('.like-counter' + postid).html(parseInt($('.like-counter' + postid).html(), 10) + 1)
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
                $('.like-counter' + postid).html(parseInt($('.like-counter' + postid).html(), 10) - 1)
            }
        });
    }
});
// share counter
$('.share_button').click(function () {
    var $this = $(this);
    var postid = $this.data('postid');
    var token = '{{{ csrf_token() }}}';
    var data = {"_token": token, "id": postid};
    if (cookies_enabled()) {
        if ($.cookie("share" + postid)) {
            // cookie exist, already count share, do nothing
        } else {
            // add share counter
            $.ajax({
                url: "/post/incrementsharecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $.cookie("share" + postid, postid, {expires: 1});
                    $('.share-counter' + postid).html(parseInt($('.share-counter' + postid).html(), 10) + 1)
                }
            });
        }
    }
});
</script>
@endsection