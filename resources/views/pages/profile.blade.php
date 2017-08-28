@extends('layouts.profile')

@section('content')
<?php Carbon::setLocale('id') ?>
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
<div class="container-fluid profile-header" style="background-image: url({{URL::asset('')}}); background-size: cover; background-repeat: no-repeat;background-color: #286090;">
    <div class="container" style="">
        <div class="col-md-12 row profile-header-content" style="">
            <div class="col-md-2 profile-pic">
                @if(strpos($users->user_image,'ttps://') || strpos($users->user_image,'ttp://'))
                <img src="{{ $users->user_image }}" onerror="avaError(this);">
                @else
                <img src="{{ URL::asset('/uploads/avatar/'.$users->user_image) }}" onerror="avaError(this);">
                @endif
            </div>
            <div class="col-md-10 profile-about" style="width: 100%;">
                <h2 class="username">{{ $users->name }}
@if(isset($users->role) && ($users->role == 'premium' || $users->role == 'admin' || $users->role == 'editor'))
<small class="verified-user">&nbsp;</small>
@endif
</h2>
                <p>{{ $profile['profesi'] or ''}}</p>
                @if(isset($profile['short_bio']))
                <p class="profile-short-bio" style="margin-bottom: 30px;">{{ $profile['short_bio'] }}</p>
                @endif
                @if(Auth::check() && $users->id !== Auth::user()->id)
                <!--logged in and not own profile, show follow button-->
                <input type="hidden" id="userid" value="{{ $users->id }}" />
                <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
                <input type="hidden" id="userid" value="{{ $users->id }}" />
                <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
                @if (isFollowing($users->id))
                <div class="col-md-2 text-center">
                    <button class="btn-default" id="btnFollowUser" style=""> <i class="fa fa-check"></i> Following</button>
                </div>
                @else
                <div class="col-md-2 text-center">
                    <button class="btn-default" id="btnFollowUser" style=""> <i class="fa fa-user-plus"></i> Follow</button>
                </div>
                @endif
                @else
                <div class="col-md-2 text-center">
                    <a href="{{url('/login')}}"><button class="btn-default" style="" id="btnFollowUser"> <i class="fa fa-user-plus"></i> Follow</button></a>
                </div>
                @endif
                <div class="col-md-1 mobile-only">&nbsp;</div>
                <div class="col-md-2 text-center">
                    <div><p>{{$jml_following}}<br><a href="#myModal2" data-toggle="modal">  Following</a></p></div>
                </div>

                <div class="col-md-2 text-center">
                    <div><p>{{$jml_followers}}<br><a href="#myModal" data-toggle="modal">  Followers</a></p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="rowspace">
<div class="col-md-8 col-md-offset-2">
    <ul class="nav nav-tabs" id="myTab">
        <li id="tulisantab" class="active"><a href="#tulisan" data-toggle="tab">Tulisan</a></li>
        <li id="buqutab"><a href="#buqu" data-toggle="tab">Buqu</a></li>
    </ul>

    <div class="tab-content" id="tab-content">
        <div class="tab-pane active" id="tulisan">
            <hr class="rowspace">
            <div class="row vertical-divider">
                @foreach ($posts as $key=>$row)
                <div class="article col-sm-3 grid-group-item">
                    <!--Image-->
                    <div class="article-image">
                        <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
                    </div>
                    <!--Article-->
                    <div class="article-info">
                        <div class="info">{{ $row->created_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                        <div class="title">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
                    </div>
                    <!--Share Like Buqu-->
                    <div class="article-action">
                        <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                        @if(Auth::check())
                        @if (isLikingBuqu($row->id))
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
        <div class="tab-pane" id="buqu">
            <hr class="rowspace">
            <div class="row vertical-divider">
                @foreach ($buqus as $key=>$row)
                <div class="article col-sm-3 grid-group-item">
                    <!--Buqu-->
                    <!--Buqu-->
                    <div id="id-title" class="buqu-info">
                        <a href="{{ url('/buqu/'.$row->buqu_slug) }}"><img style="width: 100%;height: auto;" src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" alt="{{ $row->buqu_image }}" onerror="buquError(this);" /></a>

                        <div class="col-md-12 title" style="position: absolute;width:100%;height: 100%;top:0;margin: 0 auto;">
                            <div class="col-md-12 penulis" style="position: absolute; top:10;text-align: center;margin: 0 auto;;width: 100%;font-size: 15px;">
                                {{ HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_authors->name)}}
                            </div>
                            <div class="col-md-12 judul" style="position: absolute; bottom:5%;text-align: center;margin: 0 auto;">
                                {{ HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_title)}}
                            </div>
                        </div>
                    </div>
                    <!--Share Like Buqu-->
                    <div class="article-action">
                        <span class="action-button"><i class="fa fa-newspaper-o"></i> {{ get_buqu_post_count($row->id) }}</span>
                        <span class="action-button"><a class="share_buttonbuqu" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counterbuqu{{ $row->id }}">{{$row->share_count}}</span></a></span>
                        @if(Auth::check())
                        @if (isLikingBuqu($row->id))
                        <span class="action-button"><a class="active btnLikeBuqu" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counterbuqu{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                        @else
                        <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLikeBuqu" title="Like"><i class="fa fa-heart"></i> <span class="like-counterbuqu{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                        @endif
                        @else
                        <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                        @endif
                    </div>
                    <br>
                    <div class="sharebuqu{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='' data-title='Qureta - {{ $row->buqu_title }}' data-link='{{ url('/buqu/'.$row->buqu_slug) }}' data-image='{{ url('/buqu/'.$row->buqu_image) }}'></div></div>

                </div>
                @if ($key%4==3)
            </div>

            <hr class="row-divider">
            <div class="row topic-title">
                @endif
                @endforeach
            </div>
            @if (method_exists($buqus,'render') && $buqus->lastPage()>1)
            <div class="pagination-wrapper"> {!! $buqus->render() !!} </div>
            @endif
        </div>
        <div class="tab-pane" id="pengikut">
            <hr class="rowspace">
            <div class="row">
                @foreach ($followers as $key=>$row)
                <div class="article col-sm-3 grid-group-item">
                    <!--Author-->
                    <div class="user-info">
                        <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->followers->user_image) }}" onerror="avaError(this);" /></div>
                        <div class="name">{{ HTML::link('/profile/'.$row->followers->username, $row->followers->name)}}</div>
                        <div class="title">{{ get_user_profesi($row->followers->id) }}</div>
                        <div class="jumlah">{{ get_user_profesi($row->followers->id) }}</div>
                    </div>
                </div>
                @if ($key%4==3)
            </div>
            <hr class="row-divider">
            <div class="row">
                @endif
                @endforeach
            </div>
            @if (method_exists($followers,'render') && $followers->lastPage()>1)
            <div class="pagination-wrapper"> {!! $followers->render() !!} </div>
            @endif
        </div>
        <div class="tab-pane" id="mengikuti">
            <hr class="rowspace">
            <hr class="rowspace">
            <div class="row">
                @foreach ($followings as $key=>$row)
                <div class="article col-sm-3 grid-group-item">
                    <!--Author-->
                    <div class="user-info">
                        <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->users->user_image) }}" onerror="avaError(this);" /></div>
                        <div class="name">{{ HTML::link('/profile/'.$row->users->username, $row->users->name)}}</div>
                        <div class="title">{{ get_user_profesi($row->users->id) }}</div>
                    </div>
                </div>
                @if ($key%4==3)
            </div>
            <hr class="row-divider">
            <div class="row">
                @endif
                @endforeach
            </div>
            @if (method_exists($followings,'render') && $followings->lastPage()>1)
            <div class="pagination-wrapper"> {!! $followings->render() !!} </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog"  style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Followers</h4>
            </div>
            <div class="modal-body">
                <div class="tab-pane" id="pengikut">
                    <hr class="rowspace">
                    <div class="row">
                        @foreach ($followers as $key=>$row)
                        <div class="article col-sm-3 grid-group-item">
                            <!--Author-->
                            <div class="user-info">
                                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->followers->user_image) }}" onerror="avaError(this);" /></div>
                                <div class="name">{{ HTML::link('/profile/'.$row->followers->username, $row->followers->name)}}</div>
                                <div class="title">{{ get_user_profesi($row->followers->id) }}</div>

                            </div>
                            <br>
                        </div>
                        @if ($key%4==3)
                    </div>

                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                    @if (method_exists($followers,'render') && $followers->lastPage()>1)
                    <div class="pagination-wrapper"> {!! $followers->render() !!} </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal2" class="modal fade">
    <div class="modal-dialog"  style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Following</h4>
            </div>
            <div class="modal-body">
                <div class="tab-pane" id="mengikuti">
                    <hr class="rowspace">
                    <hr class="rowspace">
                    <div class="row">
                        @foreach ($followings as $key=>$row)
                        <div class="article col-sm-3 grid-group-item">
                            <!--Author-->
                            <div class="user-info">
                                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->users->user_image) }}" onerror="avaError(this);" /></div>
                                <div class="name">{{ HTML::link('/profile/'.$row->users->username, $row->users->name)}}</div>
                                <div class="title">{{ get_user_profesi($row->users->id) }}</div>
                            </div>
                            <br>
                        </div>
                        @if ($key%4==3)
                    </div>

                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                    @if (method_exists($followings,'render') && $followings->lastPage()>1)
                    <div class="pagination-wrapper"> {!! $followings->render() !!} </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addjs')
<!-- bootstrap editable -->
<link href="/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="/bootstrap-editable/js/bootstrap-editable.js"></script>

<script>
$(document).ready(function () {
    /** force crop thumbnails **/
    var articleimage = $('.article-image');
    var width = articleimage.width();
    articleimage.css('height', width * 157 / 262);

    var url = window.location.href;
    if (url.indexOf('tulisanpage') !== -1) {
        $('#myTab').children().removeClass('active');
        $('#tab-content').children().removeClass('active');
        $('#tulisantab').addClass('active');
        $('#tulisan').addClass('active');
    }
    if (url.indexOf('buqupage') !== -1) {
        $('#myTab').children().removeClass('active');
        $('#tab-content').children().removeClass('active');
        $('#buqutab').addClass('active');
        $('#buqu').addClass('active');
    }
    if (url.indexOf('followerpage') !== -1) {
        $('#myTab').children().removeClass('active');
        $('#tab-content').children().removeClass('active');
        $('#pengikuttab').addClass('active');
        $('#pengikut').addClass('active');
    }
    if (url.indexOf('followingpage') !== -1) {
        $('#myTab').children().removeClass('active');
        $('#tab-content').children().removeClass('active');
        $('#mengikutitab').addClass('active');
        $('#mengikuti').addClass('active');
    }
});

$('#btnFollowUser').click(function () {
    var $this = $(this);
    $this.toggleClass('active');
    var userid = document.getElementById('userid').value;
    var followerid = document.getElementById('followerid').value;
    var token = '{{{ csrf_token() }}}';
    var data = {"_token": token, "userid": userid, "followerid": followerid};
    if ($this.hasClass('active')) {
        $.ajax({
            url: "/user/follow",
            type: "POST",
            data: data,
            error: function (exception) {
                console.log(data)
            },
            success: function () {
                $this.html('<i class="fa fa-check"></i> Following');
            }
        });
    } else {
        $.ajax({
            url: "/user/unfollow",
            type: "POST",
            data: data,
            error: function (exception) {
                console.log(data)
            },
            success: function () {
                $this.html('<i class="fa fa-user-plus"></i> Follow');
            }
        });
    }
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
    $('.shareaholic-share-button.ng-scope').css('display', 'block');
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
</script>
@endsection
