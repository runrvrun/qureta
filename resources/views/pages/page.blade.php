@extends('layouts.app')


@section('addhead')
@endsection

@section('content')
<section id="content">
    <div class="container">
      <div class="main-content">
          <!-- Single -->
          <div class="column-two-third single" >
              <h1>{!! $page->post_title !!}</h1>

              {!! $page->post_content !!}

              </div>
          <!-- /Single -->
      </div>
      <div class="column-one-third">
        <div class="sidebar article-list">
          <h5 class="line"><span>Terpopuler</span></h5>
            <?php $populer = get_popular_post(); ?>  
          @component('components.article_list_smimage', ['posts' => $populer])
          @endcomponent
        </div>
        <div class="sidebar user-snip">
            <h5 class="line"><span>Penulis Favorit</span></h5>
              <ul>
                <?php $terfavorit = get_penulis_favorit(); ?>
                @foreach ($terfavorit as $key=>$row)
                <li>
                  @component('components.user', ['row' => $row])
                  @endcomponent
                </li>
                @endforeach
              </ul>
          </div>
              @component('components.footer_menu')
              @endcomponent
        </div>
    </div>
</section>
@endsection


@section('addfooter')
@endsection
