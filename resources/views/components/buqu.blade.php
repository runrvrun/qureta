<!-- buqu component -->
<div class="buqu-info">
  <a href="{{ url('/buqu/'.$row->buqu_slug) }}">
    <div class="buqu-image" style="background-image: url('{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}'), url('{{ URL::asset('images/nocover.jpg') }}');"></div>
  </a>
  <div class="buqu-info-float buqu-author-name">
      {{ HTML::link('/profile/'.$row->buqu_authors->username, $row->buqu_authors->name)}}
  </div>
  <div class="buqu-info-float buqu-title">
      {{ HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_title)}}
  </div>
</div>
<!-- / buqu component -->
