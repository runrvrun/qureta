@extends('layouts.home')

@section('title')
@endsection

@section('addcss')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>    
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
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

<div class="container" style="overflow:hidden">
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">
                    {!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}
                </div>
            </div>
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='{{ $row->post_title }} | Qureta' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'>
	</div>
	</div>
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>                        
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
<?php
$recommended_writers = get_recommended_user();
?>
@if(count($recommended_writers)>0)
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--recommended writers-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/penulis-favorit', 'PENULIS FAVORIT')}}</h3>
        </div>
    </div>
    <div class="row recommended-user">
    @foreach($recommended_writers as $recw)          
        <div class="article col-sm-3 grid-group-item">
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
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>                    
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
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
                <a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" /></a>
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">{{ $row->published_at->diffForHumans() }} &middot; <i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} views</div>
                <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            </div>
            <!--Share Like Buqu-->
            <!--div class="article-action">
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
            </div-->         
            <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='26649626' data-title='Qureta - {{ $row->post_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
        </div>     
        @endif
        @endforeach
    </div>   
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
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
                        <div class="article-action">
                            <span class="action-button"><i class="fa fa-newspaper-o"></i> {{ get_buqu_post_count($row->id) }}</span>
                            <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
                            @if(Auth::check()) 
                            @if (isLikingBuqu($row->id))
                            <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                            @else
                            <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
                            @endif
                            @else                
                            <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
                            @endif
                        </div>    
                        <div class="share{{ $row->id }}" style="display:none">
                            <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='' data-title='Qureta - {{ $row->buqu_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'>
                            </div>
                        </div>    
                    </div>
                </div> 
            </div>
            @endforeach   
        </div>
    </div>
    <hr class="hr-home" style="margin-top: 30px; margin-bottom: 10px; border: 0;border-top: 1px solid #eee;">
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
<script>
$(document).ready(function () {
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
</script>
@endsection