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
        <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}
@if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
        <div class="title">{{ get_user_profesi($row->post_author) }}</div>
        <div class="clearfix"></div>
    </div>
    <!--Image-->
    <div class="article-image">
        <img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" />
    </div>
    <!--Article-->
    <div class="article-info">
        <div class="info">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</div>
        <div class="title">{!! ($row->post_status === 'publish')? '':'<small>('.$row->post_status.')</small>' !!} {!! HTML::link('/post/'.$row->post_slug, strip_tags($row->post_title))!!}</div>
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
        <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='' data-title='Qureta - {!! $row->post_title !!}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
</div>
@if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row vertical-divider">
@endif
@endforeach
</div>
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
</script>
