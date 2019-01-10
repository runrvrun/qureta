@if(isset($row))
  @if(isset($row->post_image))
  <div class="article-image-sm alignleft"
       style="width:140px;height:90px;background-image: url('{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}'),url('{{ URL::asset('/images/noimage.jpg') }}');">
  </div>
  @else
  <div class="article-image-sm alignleft"
       style="width:140px;height:90px;background-image: url('{{ URL::asset('/images/noimage.jpg') }}');">
  </div>
  @endif
  <!-- Author image, name -->
  @component('components.post_author_nophoto', ['row' => $row])
  @endcomponent
  <!-- / Author image, name -->
  <p>
      <span style=" height: 61px; overflow: none;"><a  href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a></span>
  </p>
  <span style="margin-left: 10px; object-position: center;  margin-top: -20px;" class="meta alignleft">{{ $row->published_at->diffForHumans() }} &middot; <i class="fa fa-eye"></i> {{ number_format($row->view_count,0,',','.') }} </span>
@endif
