<ul>
  @foreach ($posts as $key=>$row)
    <li>
      <a href="{{ url('/post/'.$row->post_slug) }}" class="title">{{ $row->post_title }}</a>
      <span class="meta" style="text-align:left">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca </span>
    </li>
    @endforeach
</ul>
