<!-- Article Snippet -->
<div class="article-box">
@component('components.post_author', ['row' => $row])
@endcomponent
@if($row->sticky && (Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor')))
    <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
@endif
<div class="article-image"
     style="background-image: url('{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}'),url('{{ URL::asset('/images/noimage.jpg') }}');">
</div>
<?php $topik = get_post_topik($row->id)  ?>
<span class="meta">
  @if($row->post_status <> 'publish')
    ({{ strtoupper($row->post_status) }}) &middot;
  @endif
  @if(isset($row->published_at))
    {{ $row->published_at->diffForHumans() }} &middot;
  @endif
  <i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} <!--  &middot;
  @if(isset($topik->category_title))
   <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a>
  @endif -->
</span>
<h6 class="regular article-title"><a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a></h6>
</div>
<!-- / Article Snippet -->
