<style>
  body{
    background-color: #ECEFEF !important;
  }
  @media only screen and (min-width: 768px), (-webkit-max-device-pixel-ratio: 1.25), (max-resolution: 120dpi) {
    body{
      background-color: #FFF !important;
    }
  }
</style>
@extends('layouts.home')

@section('title')
@endsection

@section('addcss')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
@endsection

@section('content')
<!-- terpopuler-now mobile -->
<div id="wrap" class="mobile-only">
	<div style="width:100vw;overflow:hidden;">
	<div class="slideshow-populer-now-mobile" style="margin-top:100px;">
		@foreach ($populer_today as $key=>$row)
			<div class="terpopuler-home-atas-col" title="{{ $row->post_title }}" style="background:linear-gradient(rgba(0,0,0,0)0%,rgba(0,0,0,0)60%, rgba(0,0,0,0.7)95%),url('{{ URL::asset('/uploads/post/'.$row->post_image) }}');background-size:cover;background-position:center;height:18em;position:relative">
				<center> <a href="{{ url('/post/'.$row->post_slug) }}"> <h3 class="terpopuler-home-atas-title-mobile" align="center" style="text-shadow:0px 2px 5px rgba(0,0,0,0.9);width:100%;padding:20px;padding-bottom:0px;">{{ $row->post_title }}</h3></a></center>
		</div>
		@endforeach
	</div>
</div>
</div>
<!-- terpopuler-now desktop -->
<div id="wrap" class="desktop-only">
<div class=" terpopuler-home-atas" style="width:100%;overflow:hidden;padding:0px;margin:0px;">
	<div class="row" style="padding:0px;margin:0px;">
		@foreach ($populer_today as $key=>$row)
		<a href="{{ url('/post/'.$row->post_slug) }}">
		<div class="terpopuler-home-atas-col col-md-4 col-xs-12" title="{{ $row->post_title }}" style="background:linear-gradient(rgba(0,0,0,0)0%,rgba(0,0,0,0)60%, rgba(0,0,0,0.9)95%),url('{{ URL::asset('/uploads/post/'.$row->post_image) }}');background-size:cover;background-position:center;height:22em;position:relative">
			<center> <h3 class="terpopuler-home-atas-title" align="center" style="width:90%;text-shadow:0px 2px 5px rgba(0,0,0,0.9)">{{ $row->post_title }}</h3></center>
			<div class="terpopuler-home-atas-info" style="padding:5px 10px;">
			<div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name" style="color:white">
                {{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
                @if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
                <small class="verified-user" style="width:15px;" title="verified-user">&nbsp;</small>
                @endif
                </div>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca </div>
			</div>
			</div>
		</div>
		</a>
		@endforeach
	</div>
</div>
</div>
<div class="container" style="overflow:hidden">
  @if (Session::has('flash_message'))
  <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <p>{!! Session::get('flash_message') !!}</p>
  </div>
  @endif
  @if (Session::has('login_message'))
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 alert alert-success alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('login_message') !!}</p>
        @if(empty( get_user_profesi(Auth::user()->id) ))
        <small>Anggota lain ingin tahu profesi Anda {!! HTML::link('/profile/edit','[update profesi]') !!}</small>
        @elseif(empty( Auth::user()->user_image ))
        <small>Anggota lain penasaran seperti apa foto Anda {!! HTML::link('/profile/edit','[upload foto]') !!}</small>
        @elseif(empty( get_user_short_bio(Auth::user()->id) ))
        <small>Ceritakan sedikit tentang diri Anda agar orang lain tahu siapa Anda {!! HTML::link('/profile/edit','[isi biodata singkat]') !!}</small>
        @endif
    </div>
  </div>
  @endif
  <?php Carbon::setLocale('id'); ?>
  @if(Auth::Check())
  <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
  @endif
  <!-- <div class="mobile-only spacer" style="min-height:50px;"></div> -->
  @if($newsflash)
  <div class="row topic-title">
      <div class="col-sm-12 newsflash">
          {{ HTML::link($newsflash->link,$newsflash->text) }}
      </div>
  </div>
  @endif
    <!--topic row 1-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/aktual', 'AKTUAL')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        <?php
            //put sticky post in random position
            $ori = $aktual;
            $temp = array();
            if($ori[0]->sticky){
            $stickypos = rand(1,4);
            for($i=1;$i<=3;$i++){
                if($i>=$stickypos){
                    $temp[$i+1] = $ori[$i];
                }else{
                    $temp[$i-1] = $ori[$i];
                }
            }
            $temp[$stickypos] = $ori[0];
            $ori = $temp;
            ksort($ori);
            $aktual = array_values($ori);
            }
        ?>
        @foreach ($aktual as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br>
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <?php $topik = get_post_topik($row->id)  ?>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></div>
                <div class="title">
                    {!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
		<hr class="row-divider desktop-only">
    <!--topic row 2-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/inspiratif', 'INSPIRATIF')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        <?php
            //put sticky post in random position
            $ori = $inspiratif;
            $temp = array();
            if($ori[0]->sticky){
            $stickypos = rand(1,4);
            for($i=1;$i<=3;$i++){
                if($i>=$stickypos){
                    $temp[$i+1] = $ori[$i];
                }else{
                    $temp[$i-1] = $ori[$i];
                }
            }
            $temp[$stickypos] = $ori[0];
            $ori = $temp;
            ksort($ori);
            $inspiratif = array_values($ori);
            }
        ?>
        @foreach ($inspiratif as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <?php $topik = get_post_topik($row->id)  ?>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <?php
    $recommended_writers = get_recommended_user();
    ?>
    @if(count($recommended_writers)>0)
        <!--recommended writers-->
        <div class="row topic-title">
            <div class="col-sm-12">
                <h3>{{ HTML::link('/penulis-favorit', 'PENULIS FAVORIT')}}</h3>
            </div>
        </div>
        <div class="row penulis-slider recommended-user" style="height: 115px;" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
        @foreach($recommended_writers as $recw)
            <div class="article col-sm-3 grid-group-item" style="padding:0px;">
                <div class="user-info">
                    @if(strpos($recw->user->user_image,'ttps://') || strpos($recw->user->user_image,'ttp://'))
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
                    <!--logged in and not own profile, show follow button-->
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
        @endforeach
        </div>
    @endif
    <!--topic row 3-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/jenaka', 'JENAKA')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        <?php
            //put sticky post in random position
            $ori = $jenaka;
            $temp = array();
            if($ori[0]->sticky){
            $stickypos = rand(1,4);
            for($i=1;$i<=3;$i++){
                if($i>=$stickypos){
                    $temp[$i+1] = $ori[$i];
                }else{
                    $temp[$i-1] = $ori[$i];
                }
            }
            $temp[$stickypos] = $ori[0];
            $ori = $temp;
            ksort($ori);
            $jenaka = array_values($ori);
            }
        ?>
        @foreach ($jenaka as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <?php $topik = get_post_topik($row->id)  ?>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot;  <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
		<hr class="row-divider desktop-only">
    <!--topic row 4-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/kiat', 'KIAT')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        <?php
            //put sticky post in random position
            $ori = $kiat;
            $temp = array();
            if($ori[0]->sticky){
            $stickypos = rand(1,4);
            for($i=1;$i<=3;$i++){
                if($i>=$stickypos){
                    $temp[$i+1] = $ori[$i];
                }else{
                    $temp[$i-1] = $ori[$i];
                }
            }
            $temp[$stickypos] = $ori[0];
            $ori = $temp;
            ksort($ori);
            $kiat = array_values($ori);
            }
        ?>
        @foreach ($kiat as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <?php $topik = get_post_topik($row->id)  ?>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot;  <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <?php
    $productive_writers = get_productive_user();
    ?>
    @if(count($productive_writers)>0)
        <!--recommended writers-->
        <div class="row topic-title">
            <div class="col-sm-12">
                <h3>{{ HTML::link('/penulis-favorit', 'PENULIS PRODUKTIF')}}</h3>
            </div>
        </div>
        <div class="row penulis-slider recommended-user" style="height: 115px;" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
        @foreach($productive_writers as $recw)
            <div class="article col-sm-3 grid-group-item" style="padding:0px;">
                <div class="user-info">
                    @if(strpos($recw->user_image,'ttps://') || strpos($recw->user_image,'ttp://'))
                    <div class="image"><img src="{{ $recw->user_image }}" alt="{{ $recw->user_image }}" onerror="avaError(this);" /></div>
                    @else
                    <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$recw->user_image) }}" alt="{{ $recw->user_image }}" onerror="avaError(this);" /></div>
                    @endif
                    <div class="name">{{ HTML::link('/profile/'.$recw->username, $recw->name)}}
    @if(isset($recw->role) && ($recw->role == 'premium' || $recw->role == 'partner' || $recw->role == 'admin' || $recw->role == 'editor'))
    <span class="verified-user"></span>
    @endif
    </div>
                    <div class="title">{{ get_user_profesi($recw->id) }}
                    </div>
                    @if(Auth::check() && $recw->id !== Auth::user()->id)
                    <!--logged in and not own profile, show follow button-->
                    @if (isFollowing($recw->id))
                    <div>
                        <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->id }}" style="background-color: #337ab7;"> <i class="fa fa-check"></i> Following</button>
                    </div>
                    @else
                    <div>
                        <button class="btn btn-primary btnFollowUser" data-userid="{{ $recw->id }}" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button>
                    </div>
                    @endif
                    @else
                    <div>
                        <a href="{{url('/login')}}"><button class="btn btn-primary btnFollowUser" style="background-color: #337ab7;"> <i class="fa fa-user-plus"></i> Follow</button></a>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    @endif
    <!--topic row 5-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/topik-redaksi/fiksi', 'FIKSI')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        <?php
            //put sticky post in random position
            $ori = $fiksi;
            $temp = array();
            if($ori[0]->sticky){
            $stickypos = rand(1,4);
            for($i=1;$i<=3;$i++){
                if($i>=$stickypos){
                    $temp[$i+1] = $ori[$i];
                }else{
                    $temp[$i-1] = $ori[$i];
                }
            }
            $temp[$stickypos] = $ori[0];
            $ori = $temp;
            ksort($ori);
            $fiksi = array_values($ori);
            }
        ?>
        @foreach ($fiksi as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <?php $topik = get_post_topik($row->id)  ?>
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
		<hr class="row-divider desktop-only">
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('artikel-populer', 'TERPOPULER')}}</h3>
        </div>
    </div>
    <div class="row vertical-divider">
        @foreach ($posts as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br class="break-mobile">
            <div class="user-info">
                @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
                <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @else
                <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>
                @endif
                <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
                <div class="title">{{ get_user_profesi($row->post_author) }}
                @if(Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor'))
                    @if($row->sticky)
                    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
                    @endif
                @endif
                </div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; <i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} views</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
		<hr class="row-divider desktop-only">
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('https://kuliah.qureta.com', 'KULIAH QURETA')}}</h3>
        </div>
    </div>
    <div class="row kuliah-slider" style="height: 315px;" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
        @foreach ($kuliah as $key=>$row)
        @if($key<4)
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <br>
            <div class="user-info">
                <div class="image"><img src="https://kuliah.qureta.com/uploads/teacher/{{ $row->teachers->url_foto }}" alt="{{ $row->teachers->url_foto }}" onerror="avaError(this);" /></div>
                <div class="name">{{ $row->teachers->name }}</div>
                <div class="title">{{ $row->teachers->job }}</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <a href="https://kuliah.qureta.com"><img src="https://kuliah.qureta.com/uploads/course/{{ $row->url_foto }}" alt="{{ $row->url_foto }}" onerror="imgError(this)" /></a>
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">
                    {{ $row->lectures->count()+1 }} video &middot; {{ $row->course_users->count() }} peserta
                </div>
                <div class="title">
                    {!! HTML::link('https://kuliah.qureta.com/course/'.$row->slug, $row->name)!!}
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
		<hr class="row-divider desktop-only">
    <!--slider and banner-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/buqu', 'BUQU')}}</h3><small><a href="{{url('/post/begini-cara-membuat-buqu-di-qureta')}}">Ingin membuat buqu? Begini caranya</a></small>
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
        </div>
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
</div>
@endsection
@section('addjs')
<script type="text/javascript" src="slick/slick.min.js"></script>
<!--slider (slick)-->
<script>
    $(document).ready(function (e) {
        $('.penulis-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: true,
            swipe: true,
            arrows: false,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
        $('.buqu-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            pauseOnHover: true,
            swipe: true,
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
        $('.kuliah-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            pauseOnHover: true,
            swipe: true,
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

$(document).ready(function () {
    $('.img-slider').show();
		$('.slideshow-populer-now-mobile').slick({
    	autoplay: true,
			accessibility: false,
			autoplaySpeed: 10000
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

$('.btnFollowUser').click(function () {
    var $this = $(this);
    $this.toggleClass('active');
    var userid = $this.data('userid');
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
$(document).ready(function(){
    $('.slide-btn').click(function () {
        $(".form-slide").animate({width:'toggle'},350);
    });
});
</script>
@endsection
