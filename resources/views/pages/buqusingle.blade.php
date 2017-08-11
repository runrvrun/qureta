@extends('layouts.app')

@section('title')
- {{ $buqu->buqu_title }}
@endsection

@section('content')
<?php Carbon::setLocale('id'); ?>

<div class="clearfix"></div>
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
<div class="clearfix"></div>

<div class="row">
<br> 
<div class="col-md-4">
</div>
    <div class="col-md-4">
    <div class="buqu-single buqu-info" style="">
        <img src="{{ URL::asset('uploads/buqu/'.$buqu->buqu_image) }}" onerror="buquError(this);" alt="{{ $buqu->buqu_image }}" />
             <div class="col-md-12 title" style="position: absolute;width:100%;height: 100%;top:0;margin: 0 auto;">
                                <div class="col-md-12 penulis" style="position: absolute; top:5%;text-align: center;margin: 0 auto;width: 100%;font-size: 15px;text-shadow: 2px 2px 4px #979aa0;">
                                    {{ HTML::link('/profile/'.$buqu->buqu_authors->username, $buqu->buqu_authors->name)}}
                                </div>
                                 <div class="col-md-12 judul" style="position: absolute; bottom:10%;padding-right: -50px;text-shadow: 2px 2px 4px #979aa0;">
                                {{ HTML::link('/buqu/'.$buqu->buqu_slug, $buqu->buqu_title)}}
                                {{ Counter::count('buqu', $buqu->id) }}
                                </div>
                            </div>       
            </div>
    </div>
    </div>
<div class="content">
<div class="col-md-12 select-view">       
        <div class="btn-group" role="group">
            <button  type="button" id="grid" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button>
            <button  type="button" id="list" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button>                
        </div>
    </div>
    <br>
    <hr class="rowspace">
    <div class="row vertical-divider">
                @foreach ($posts as $key=>$row)                       
        <div class="article col-sm-3 grid-group-item">    
            @if(Auth::check())
            @if(Auth::user()->id == $buqu->buqu_author || Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
            <a onclick="return confirm('Hapus artikel ini dari buqu?')" class="fa fa-times-circle fa-2x delete-btn top-right" title="Hapus artikel dari buqu" data-postid="{{ $row->id }}"></a>
            @endif
            @endif
            <!--Author-->
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>       
            <!--Article-->
            <div class="article-info">                            
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
                <span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span>
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
    <div class="pagination-wrapper"> {!! $posts->render() !!} </div>
    @endif    
</div>
<div class="clearfix"></div>
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

    $('.share_button').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        $('.share' + postid).toggle();
        $('.shareaholic-share-button.ng-scope').css('display', 'block');
    });
//share counter
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

    //share like for Buqu
    $('.btnLikeBuqu').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = $this.data('postid');
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/buqu/like",
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
                url: "/buqu/incrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('.like-counterbuqu' + postid).html(parseInt($('.like-counterbuqu' + postid).html(), 10) + 1)
                }
            });
        } else {
            $.ajax({
                url: "/buqu/unlike",
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
                url: "/buqu/decrementlikecounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('.like-counterbuqu' + postid).html(parseInt($('.like-counterbuqu' + postid).html(), 10) - 1)
                }
            });
        }
    });
// share counter
    $('.share_buttonbuqu').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        $('.sharebuqu' + postid).toggle();
        $('.shareaholic-share-button.ng-scope').css('display', 'block');
    });

    $('.share_buttonbuqu').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "id": postid};
        if (cookies_enabled()) {
            if ($.cookie("sharebuqu" + postid)) {
                // cookie exist, already count share, do nothing
            } else {
                // add share counter
                $.ajax({
                    url: "/buqu/incrementsharecounter",
                    type: "POST",
                    data: data,
                    error: function (exception) {
                        console.log(data)
                    },
                    success: function () {
                        $.cookie("sharebuqu" + postid, postid, {expires: 1});
                        $('.share-counterbuqu' + postid).html(parseInt($('.share-counterbuqu' + postid).html(), 10) + 1)
                    }
                });
            }
        }
    });
    //feature buqu
    $('#featuredbuqu').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        var postid = $this.data('postid');
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/buqu/feature",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#featuredbuqu').removeClass('btn-default');
                    $('#featuredbuqu').addClass('btn-warning');
                    $('#featuredbuqu').html('<i class="fa fa-star"></i> Buqu Pilihan');
                }
            });
        } else {
            $.ajax({
                url: "/buqu/unfeature",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                    $('#featuredbuqu').removeClass('btn-warning');
                    $('#featuredbuqu').addClass('btn-default');
                    $('#featuredbuqu').html('<i class="fa fa-star-o"></i> Buat Buqu Pilihan');
                }
            });
        }
    });

    $('.delete-btn').click(function () {
        var $this = $(this);
        var postid = $this.data('postid');
        var buquid = document.getElementById('buquid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "buquid": buquid};
        //delete article from buqu
        $.ajax({
            url: "/buqu/deletepost",
            type: "POST",
            data: data,
            error: function (exception) {
                console.log(data)
            },
            success: function () {
                $this.parent().fadeOut(300);
            }
        });
    });
</script>
@endsection