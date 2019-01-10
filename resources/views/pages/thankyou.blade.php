@extends('layouts.app')


@section('addhead')
@endsection

@section('content')
<section id="content">
    <div class="container">
      <div class="main-content">
          <div class="column-two-third single">


            <h3>Naskah Terkirim</h3>
            <p>Terima kasih, naskah anda telah kami terima.</p>
            <p>Editor kami akan menyunting naskah anda sebelum terbit dan akan mengabari anda melalui email atau pesan di Qureta.</p>
            <p>{{ isset($addmsg)? $addmsg:'' }}</p>
            <br>
            <a href="{{ url('/') }}" class="btn btn-warning">&laquo; Kembali ke halaman depan</a>


          </div>
      </div>
      <div class="column-one-third">
      	  <div class="sidebar article-list">
          	<h5 class="line"><span>Terpopuler</span></h5>
            <?php $populer = get_popular_post(); ?>
            @component('components.article_list_smimage', ['posts' => $populer])
            @endcomponent
          </div>
          <div class="sidebar user-snip">
             <?php $populer = get_popular_post(); ?>
            	<h5 class="line"><span>Penulis Favorit</span></h5>
                <ul>
                  @foreach ($populer as $key=>$row)
                  <li>
                    @component('components.user', ['row' => $row])
                    @endcomponent
                  </li>
                  @endforeach
                  <li>
                    {{ HTML::link('/penulis-favorit','Penulis lainnya &raquo;',['style'=>'float:right']) }}
                  </li>
                </ul>
            </div>
            @component('components.footer_menu')
            @endcomponent
      </div>
      @component('components.adsense')
              @endcomponent
    </div>
</section>
@endsection

@section('addfooter')
@endsection
