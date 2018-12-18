<a href="{{ url('/post/'.$row->post_slug) }}"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_title }}" class="alignleft" /></a>
<!-- Author image, name -->
@component('components.post_author_nophoto', ['row' => $row])
@endcomponent
<!-- / Author image, name -->
<p>
    <a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a>
</p>
