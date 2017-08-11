@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
{{ Carbon::setLocale('id') }}
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
@if (isset($_SESSION['flash_message']))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{{ Session::get('flash_message') }}</p>
</div>
@endif

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
    @foreach ($posts as $key=>$row)                       
    <div class="article col-sm-3 grid-group-item">        
        <!--Author-->
        <br>
        <div class="user-info">
            @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
            <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
	    @else
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
            @endif
            <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
            <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            <div class="clearfix"></div>
        </div>
        <!--Image-->
        <div class="article-image">
            <img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" />
        </div>       
        <!--Article-->
        <div class="article-info">                
            
            <div class="title">{!! ($row->post_status === 'publish')? '':'<small>('.$row->post_status.')</small>' !!} {{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
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
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>                 
    </div>  
        
    @if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row vertical-divider">
    @endif
    @endforeach    
</div>
@if (method_exists($posts,'render') && $posts->lastPage()>1)
@if(isset($querystring['sp']) && isset($querystring['q']))
<div class="pagination-wrapper"> {!! $posts->appends(['sp' => $querystring['sp'],'q' => $querystring['q']])->render() !!} </div>
@else
<div class="pagination-wrapper"> {!! $posts->render() !!} </div>
@endif
@endif

@endsection
@section('addjs')
<script type="text/javascript" src="slick/slick.min.js"></script>
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

function cookies_enabled()
{
    var cookieEnabled = (navigator.cookieEnabled) ? true : false;

    if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
    {
        document.cookie = "testcookie";
        cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
    }
    return (cookieEnabled);
}

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
    $('.share' + postid).toggle();
    $('.shareaholic-share-button.ng-scope').css('display','block');
});

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