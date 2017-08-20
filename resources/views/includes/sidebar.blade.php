
<div>
<br>
    <h4 style="color: #EB4320">TERPOPULER</h4>
    <br><br>
    @foreach($populer as $key=>$rel)
    <div class="row">
        <div class="col-md-4" >
            <!--Image-->
            <div class="article-image sidebar">
                <a href="{{ url('post/'.$rel->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$rel->post_image) }}" alt="{{ $rel->post_image }}" onerror="imgError(this);" /></a>
            </div>
        </div>
        <div class="col-md-8 article-sidebar">
            <!--Article-->   
              
           <div class="judul">{{ HTML::link('/post/'.$rel->post_slug, $rel->post_title)}}</div>
           
        </div>

    </div>
    <hr>
    @endforeach
</div>
            @if(isset($banner->image))
            <!-- banner 1 name: home-top-right, size: 336 pixel x 280 pixel -->
            <div class="main-slider-banner banner-home-top-right">                
                <a href="{{ $banner->link }}" target="_blank"><img src="{{ URL::asset('uploads/banner/'.$banner->image) }}" /></a>
            </div>
            @endif   

<?php
$recommended_writers = get_recommended_user();
?>
@if(count($recommended_writers)>0)
    <hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
    <!--recommended writers-->
    <div class="row topic-title">
        <div class="col-sm-12">
            <h3>{{ HTML::link('/penulis/favorit', 'PENULIS FAVORIT')}}</h3>
        </div>
    </div>
    @foreach($recommended_writers as $recw)          
    <div class="row recommended-user">        
        <div class="article grid-group-item">
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
    </div>
    @endforeach
@endif

                     