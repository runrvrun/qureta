@extends('layouts.profile')

@section('addcss')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
@endsection

@section('content')
<?php Carbon::setLocale('id') ?>
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
<div class="profile-new-desktop" style="background-color:#f4ffe3;display:block;padding-bottom:2em;min-height:60em;">
<div class="header-profile-new" style="background:linear-gradient(rgba(0,0,0,0)0%,rgba(0,0,0,0)80%,rgba(0,0,0,0.5)90%,rgba(0,0,0,0.9)100%),url(http://bogor.net/wp-content/uploads/2018/02/hand_writing_book_man_7986_1920x1080.jpg);background-size: cover;">
  <div class="profile-new-atas">
    <div class="user-avatar" style="float:left;">
      @if(strpos($users->user_image,'ttps://') || strpos($users->user_image,'ttp://'))
      <img src="{{ $users->user_image }}" onerror="avaError(this);">
      @else
      <img src="{{ URL::asset('/uploads/avatar/'.$users->user_image) }}" onerror="avaError(this);">
      @endif
    </div>
    <div class="user-info" style="float:right">
      <h3 style="display:inline-block">{{ $users->name }}</h3>
      @if(isset($users->role) && ($users->role == 'premium' || $users->role == 'admin' || $users->role == 'editor'))
      <small class="verified-user" style="width:15px">&nbsp;</small>
      @endif
      <p style="opacity:0.8;text-align:right;margin-right:1em;"><i>{{ $profile['profesi'] or ''}}</i></p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="user-info">
    <div class="user-info-top row" style="margin:0px;">
      <div class="col-md-6">
        <i class="fa fa-file-text-o" style="float:left;padding:3px;" aria-hidden="true"></i><span  style="float:right">{{ $jml_post }}</span>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-6">
        <i class="fa fa-book" style="float:left;padding:3px;" aria-hidden="true"></i><span style="float:right">{{ $jml_buqu }}</span>
      </div>
    </div>
    <div class="user-info-bio">
      <p style="font-style:italic;word-wrap: break-word">{{ $profile['short_bio'] or ''}}</p>
    </div>
    <div class="user-info-bottom row" style="margin:0px;">
      <div class="col-md-6">
        <center>
          <p style="margin:0px">Follower</p>
          <p>{{$jml_followers}}</p>
      </center>
      </div>
      <div class="col-md-6">
        <center>
          <p style="margin:0px">Following</p>
          <p>{{$jml_following}}</p>
        </center>
      </div>
      <div class="clearfix"></div>
      <div style="display:block;margin:auto">
        <center>
        @if(Auth::check())
            @if(Auth::user()->id != $users->id)
            <input type="hidden" id="userid" value="{{ $users->id }}" />
            <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
            <input type="hidden" id="userid" value="{{ $users->id }}" />
            <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
            @if (isFollowing($users->id))
            <div class="text-center">
                <button class="btn-default" id="btnFollowUser" style=""> <i class="fa fa-check"></i> Following</button>
            </div>
            @else
            <div class="text-center">
                <button class="btn-default" id="btnFollowUser" style="margin:auto"> <i class="fa fa-user-plus"></i> Follow</button>
            </div>
            @endif
            @endif
          @else
            <a href="{{url('/login')}}"><button class="btn-default" style="" id="btnFollowUser"> <i class="fa fa-user-plus"></i> Follow</button></a>
        @endif
        </center>
    </div>
    </div>
  </div>
</div>
<div style="margin-top:3em;"></div>
<div class="container">
  <div class="row">
    <div class="col-md-2 buqu-content" style="margin:0px;">
      @if(count($buqus) > 0)
      <div class="buqu-slick" style="display:block;overflow:hidden;border-radius:5px;">
        @foreach ($buqus as $row)
          <a href="{{ url('/buqu/'.$row->buqu_slug) }}" style="display:inline-block;position:relative;">
            <img style="width:100%;max-width:100%;" src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" onerror="buquError(this);" />
            <p style="display:block;position:absolute;bottom:0px;width:100%;text-shadow:1px 1px 3px black;color:white;padding:2px;text-align:center;font-weight:bold;">{{$row->buqu_title}}</p>
          </a>
        @endforeach
      </div>
      <p align="center">{{ HTML::link('/profile/buqu/'.$users->username,'Lihat semua buqu') }}</p>
      @else
      &nbsp;
      @endif
    </div>
    <div class="col-md-7">
      @if(count($posts) > 0)
      @foreach ($posts as $key=>$row)
      <a href="{{ url('post/'.$row->post_slug) }}">
        <div class="profile-post-list">
            <div class="profile-post-list-img" style="float:left;">
                <img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" />
            </div>
            <div class="profile-post-list-content" style="float:left;width:70%;">
                <div class="info-post" style="padding:5px 15px;font-size:12px;color:rgba(0,0,0,0.8);">
                    <div class="col-6" style="float:left">
                        <i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} views
                    </div>
                    <div class="col-6" style="float:left;margin-left:5px;">
                        <i class="fa fa-calendar" aria-hidden="true"></i> {{ $row->published_at->format('D M Y') }}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <h4>{{$row->post_title}}</h4>
            </div>
          <div class="clearfix"></div>
        </div>
      </a>
      <div style="margin-top:.5em;"></div>
      @endforeach
      @if($jml_post>count($posts))
      <center><a href="/profile/tulisan/{{ $users->username }}">Tulisan {{ $users->name }} Lainnya...</a></center>
      @endif
      @endif
    </div>
    <div class="col-md-3">
        <?php $recommended_writers = get_recommended_user(); ?>
        @if(count($recommended_writers)>0)
        @foreach($recommended_writers as $recw)
        <div class="row recommended_writers_box" style="height:6em;overflow:hidden;background-color:white;margin:10px 0px;border-radius:3px;overflow:hidden;">
            <div class="col-md-4" style="background-repeat: no-repeat;background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(http://bogor.net/wp-content/uploads/2018/02/hand_writing_book_man_7986_1920x1080.jpg);background-size: contain;height:100%;">
                <a href="/profile/{{ $recw->user->username }}">
                <div class="image" style="background-color:#ddd;height:4em;width:4em;border-radius:100%;overflow:hidden;margin:15px 0px;">
                    @if(strpos($recw->user_image,'ttps://') || strpos($recw->user_image,'ttp://'))
                    <img style="height:100%;max-height:100%;width:auto" src="{{ $recw->user->user_image }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" />
                    @else
                    <img style="height:100%;max-height:100%;width:auto" src="{{ URL::asset('/uploads/avatar/'.$recw->user->user_image) }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" />
                    @endif
                </div>
                </a>
            </div>
            <div class="col-md-8" style="padding:4px 6px;">
                <h5 style="display: inline-block !important;margin:0px;">
                    {{ HTML::link('/profile/'.$recw->user->username, $recw->user->name)}}
                </h5>
                @if(isset($recw->user->role) && ($recw->user->role == 'premium' || $recw->user->role == 'partner' || $recw->user->role == 'admin' || $recw->user->role == 'editor'))
                <i class="verified-user" style="font-size:15px;width:20px !important;"></i>
                @endif
                <i style="display:block;text-align:right;margin-right:10px;">{{ get_user_profesi($recw->user->id) }}</i>
                <div style="margin-top:10px;"></div>
                <center>
                @if(Auth::check() && $recw->user->id !== Auth::user()->id)
                    <!-- logged in and not own profile, show follow button -->
                    @if (isFollowing($recw->user->id))
                    <div>
                        <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;padding:2px 10px;"> <i class="fa fa-check"></i> Following</button>
                    </div>
                    @else
                    <div>
                        <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;padding:2px 10px;"> <i class="fa fa-user-plus"></i> Follow</button>
                    </div>
                    @endif
                @else
                <div>
                    <a href="{{url('/login')}}"><button class="btn btn-primary btnFollowUser" style="background-color: #337ab7;padding:2px 10px;"> <i class="fa fa-user-plus"></i> Follow</button></a>
                </div>
                @endif
                </center>                
            </div>
        </div>
        @endforeach
        @endif
          <!-- @if(count($recommended_writers)>0)
              @foreach($recommended_writers as $recw)
              <div class="" style="">
                  <div class="col-md-12 article grid-group-item">
                      <div class="user-info">
                          @if(strpos($recw->user_image,'ttps://') || strpos($recw->user_image,'ttp://'))
                          <div class="image"><img src="{{ $recw->user->user_image }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" /></div>
                          @else
                          <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$recw->user->user_image) }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" /></div>
                          @endif
                          <div class="name">{{ HTML::link('/profile/'.$recw->user->username, $recw->user->name)}}
          @if(isset($recw->user->role) && ($recw->user->role == 'premium' || $recw->user->role == 'partner' || $recw->user->role == 'admin' || $recw->user->role == 'editor'))
          <span class="verified-user"></span>
          @endif
          </div>
                          <div class="title">{{ get_user_profesi($recw->user->id) }}
                          </div>
                          @if(Auth::check() && $recw->user->id !== Auth::user()->id)
                          logged in and not own profile, show follow button
                          @if (isFollowing($recw->user->id))
                          <div>
                              <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;"> <i class="fa fa-check"></i> Following</button>
                          </div>
                          @else
                          <div>
                              <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button>
                          </div>
                          @endif
                          @else
                          <div>
                              <a href="{{url('/login')}}"><button class="btn btn-primary btnFollowUser" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button></a>
                          </div>
                          @endif
                      </div>
                  </div>
              </div>
              @endforeach
          @endif -->
    </div>
  </div>
</div>
</div>
  <!-- <div class="row" style="margin-top:35px">
    <div class="col-md-5 col-md-offset-2">
      <div class="row profile-main">
        <div class="spacer" style="margin-top:20px"></div>
        <div class="spacer mobile-only" style="margin-top:60px"></div>
        <div class="col-md-3 profile-pic">
            @if(strpos($users->user_image,'ttps://') || strpos($users->user_image,'ttp://'))
            <img src="{{ $users->user_image }}" onerror="avaError(this);">
            @else
            <img src="{{ URL::asset('/uploads/avatar/'.$users->user_image) }}" onerror="avaError(this);">
            @endif
        </div>
        <div class="col-md-8" style="margin-left:10px">
            <h2 class="username">{{ $users->name }}
            @if(isset($users->role) && ($users->role == 'premium' || $users->role == 'admin' || $users->role == 'editor'))
            <small class="verified-user" style="width:15px">&nbsp;</small>
            @endif
              </h2>
              <p>
              {{ $profile['profesi'] or ''}}
              @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || $users->id == Auth::user()->id))
                  <small><a href="{{url('/profile/edit/'.$users->id)}}"><i class="fa fa-pencil"></i> Edit Profile</a></small>
              @endif</p>
              @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
              @if($users->password == 'FacebookProvider')
              <p>
              <a href="https://facebook.com/{{$users->username}}">
              <i class="fa fa-facebook-official" style="font-size:24px;">
              </i>
              </a>
              </p>
              @endif
              @endif
              <hr>
              <p style="font-style:italic;color:#777">{{ $profile['short_bio'] or ''}}</p>
        </div>
      </div>
      <div class="row profile-main" style="background-color:#0776bd; padding-top:15px; padding-bottom:15px; color:#FFF;margin-bottom:10px">
        <div class="col-md-4 text-center">
          @if(Auth::check())
            @if(Auth::user()->id != $users->id)
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
            @endif
          @else
            <a href="{{url('/login')}}"><button class="btn-default" style="" id="btnFollowUser"> <i class="fa fa-user-plus"></i> Follow</button></a>
          @endif
        </div>
        <div class="col-md-4 text-center">
          {{$jml_following}} <a href="#myModal2" data-toggle="modal" style="color:#FFF">  Following</a>
        </div>
        <div class="col-md-4 text-center">
          {{$jml_followers}} <a href="#myModal" data-toggle="modal" style="color:#FFF">  Followers</a>
        </div>
      </div> -->
      <!-- POSTS -->
      <!-- @if(count($posts) > 0)
      <div class="row profile-main" style="background-color:#0776bd;color:#FFF;">
        <div class="col-md-11 col-md-offset-1"><h4>Tulisan {{ $users->name }}</h4></div>
      </div>
      @foreach ($posts as $key=>$row)
      <div class="row profile-main" style="padding-top:5px; padding-bottom:5px; border-bottom:thin #dedede solid;">
          <div class="col-md-4 col-md-offset-1" >
              <div class="article-image sidebar">
                  <a href="{{ url('post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
              </div>
          </div>
          <div class="col-md-6 article-sidebar">
             <div class="judul">{{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>
             <div class="user-info"><div class="info"><i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} views</div></div>
          </div>
      </div>
      @endforeach
      <div class="row profile-main text-center" style="margin-bottom:10px;padding:10px;">
        <div>{{ HTML::link('/profile/tulisan/'.$users->username,'Lihat semua tulisan') }}</div>
      </div>
      @endif
      BUQU
      @if(count($buqus) > 0)
      <div class="row profile-main" style="background-color:#0776bd;color:#FFF;">
        <div class="col-md-11 col-md-offset-1"><h4>Buqu {{ $users->name }}</h4></div>
      </div>
      <div class="row profile-main" style="border-bottom:thin #dedede solid;">
        @foreach ($buqus as $row)
          <div class="col-xs-6 grid-group-item">
              Author
              <br>
              <div class="panel panel-default">
                  <div class="" >
                      Buqu
                      <div class="buqu-info" style="width:100%;position: relative;">
                          <a href="{{ url('/buqu/'.$row->buqu_slug) }}"><img class="img-slider" style="width:100%;max-height:100%; max-width:100%;" src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" onerror="buquError(this);" /></a>
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
      </div>
      <div class="row profile-main text-center" style="margin-bottom:10px;padding:10px;">
        <div>{{ HTML::link('/profile/buqu/'.$users->username,'Lihat semua buqu') }}</div>
      </div>
      @endif
    </div> -->
    <!-- <div class="col-md-3">
      <div class="row profile-side">
      <div class="col-md-12"><h4>Penulis Lainnya</h4></div>
      </div>
      <?php
      $recommended_writers = get_recommended_user();
      ?>
          @if(count($recommended_writers)>0)
              @foreach($recommended_writers as $recw)
              <div class="row profile-side" style="padding-top:7px;padding-bottom:7px; border-bottom:thin #dedede solid;">
                  <div class="col-md-12 article grid-group-item">
                      <div class="user-info">
                          @if(strpos($recw->user_image,'ttps://') || strpos($recw->user_image,'ttp://'))
                          <div class="image"><img src="{{ $recw->user->user_image }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" /></div>
                          @else
                          <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$recw->user->user_image) }}" alt="{{ $recw->user->user_image }}" onerror="avaError(this);" /></div>
                          @endif
                          <div class="name">{{ HTML::link('/profile/'.$recw->user->username, $recw->user->name)}}
          @if(isset($recw->user->role) && ($recw->user->role == 'premium' || $recw->user->role == 'partner' || $recw->user->role == 'admin' || $recw->user->role == 'editor'))
          <span class="verified-user"></span>
          @endif
          </div>
                          <div class="title">{{ get_user_profesi($recw->user->id) }}
                          </div>
                          @if(Auth::check() && $recw->user->id !== Auth::user()->id)
                          logged in and not own profile, show follow button
                          @if (isFollowing($recw->user->id))
                          <div>
                              <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;"> <i class="fa fa-check"></i> Following</button>
                          </div>
                          @else
                          <div>
                              <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->user->id }}" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button>
                          </div>
                          @endif
                          @else
                          <div>
                              <a href="{{url('/login')}}"><button class="btn btn-primary btnFollowUser" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button></a>
                          </div>
                          @endif
                      </div>
                  </div>
              </div>
              @endforeach
          @endif
        <div class="row profile-side" style="padding-top:20px;"></div>
    </div>
  </div>
</div> -->
<!-- <div style="margin-top:10em;"></div> -->

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
    $('.buqu-slick').slick({
      autoplay: true,
      arrows:false,
			accessibility: false,
			autoplaySpeed: 2000
    });
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
<script type="text/javascript" src="/slick/slick.min.js"></script>
<!--slider (slick)-->
<script>
    $(document).ready(function (e) {
        $('.buqu-slider').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            pauseOnHover: true,
            swipe: true,
            arrows: true,
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
