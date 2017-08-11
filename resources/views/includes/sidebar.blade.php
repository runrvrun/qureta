
<div>
<br>
    <h4 style="color: #EB4320">TERPOPULER</h4>
    <br><br>
    @foreach($populer as $key=>$rel)
    <div class="row">
        <div class="col-md-4" >
            <!--Image-->
            <div class="article-image sidebar">
                <img src="{{ URL::asset('/uploads/post/thumb/'.$rel->post_image) }}" alt="{{ $rel->post_image }}" onerror="imgError(this);" />
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
                     