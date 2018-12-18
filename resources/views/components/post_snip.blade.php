<!-- Article Snippet -->
@if($row->sticky && (Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor')))
    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
@endif
<div class="article-image"
     style="background-image: url('{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}');">
</div>
<?php $topik = get_post_topik($row->id)  ?>
<span class="meta">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></span>
<h6 class="regular article-title"><a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a></h6>
<!-- / Article Snippet -->
