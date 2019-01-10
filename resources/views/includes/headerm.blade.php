<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
  <!-- sidebar-mobile -->
  <div id="sidebar-mobile">
      <div class="search" style="padding-top:20px">
          {!! Form::open(array('method'=>'GET', 'action'=>'QueryController@search', 'class'=>'navbar-form searchform',  'id'=>'navBarSearchForm', 'role'=>'search')) !!}
              <input type="text" name="q" placeholder="Cari artikel atau penulis" class="ft"/>
              <input type="submit" value="" class="fs">
          {!! Form::close() !!}
      </div>
    <p style="clear:both"></p>
    <div class="container-sidebar-mobile">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                <li class="dropdown">
                    <a href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-divider"></li>
                @endif
                <li class="dropdown">
                  <i class="fa fa-file"> </i>
                    <a href="{{ url('/artikel-terbaru') }}" data-toggle="dropdown" class="dropdown-toggle">Artikel</a>
                    <ul>
                        <li style="margin-bottom: 10px; margin-left: -4px;">
                          <span><i class="fa fa-pen"></i></span>
                          
                          <span><a href="{{ url('/tulisanku') }}">Tulisanku</a></span>
                        </li>
                        <li>
                          <span><i class="fa fa-fire"> </i></span>
                         <span><a  href="{{ url('/artikel-populer') }}">Terpopuler </a></li></span>

                    </ul>
                </li>
                <li class="nav-divider"></li>
                <li class="dropdown">
                  <i class="fa fa-user"> </i>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Penulis</a>
                    <ul>
                        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
                        <li style="margin-bottom: 10px; margin-left: -4px;">
                          <i class="fa fa-star"></i>
                          <a href="{{ url('/penulis-terbaru') }}">Terbaru</a></li>
                        <li style="margin-bottom: 10px; margin-left: 0px;">
                          <i class="fa fa-fire"> </i>
                          <a href="{{ url('/penulis-populer') }}">Terpopuler</a></li>
                        @endif
                        <li style="margin-bottom: 10px; margin-left: -4px;">
                          <i class="fa fa-heart"> </i>
                          <a href="{{ url('/penulis-favorit') }}">Terfavorit</a></li>
                        <li style="margin-bottom: 10px; margin-left: 0px;">
                          <i class="fa fa-bolt"> </i>
                          <a href="{{ url('/penulis-produktif') }}">Terproduktif</a></li>
                    </ul>
                </li>
                <li class="nav-divider"></li>
                <li class="dropdown">
                    <i class="fa fa-book"> </i>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Buqu</a>
                    <ul>
                        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
                        <li style="margin-bottom: 10px; margin-left: -4px;">
                          <i class="fa fa-star"> </i>
                          <a href="{{ url('/buqu-terbaru') }}">Buqu Terbaru</a></li>
                        @endif
                        <li style="margin-bottom: 10px; margin-left: -3px;">
                          <i class="fa fa-thumbs-up"> </i>
                          <a href="{{ url('/buqu-pilihan') }}">Buqu Pilihan</a></li>
                        <li style="margin-bottom: 10px; margin-left: 0px;">
                          <i class="fa fa-fire"> </i>
                          <a href="{{ url('/buqu-populer') }}">Buqu Terpopuler</a></li>
                        <li style="margin-bottom: 10px; margin-left: -7px;">
                          <i class="fa fa-tags"> </i>
                          <a href="{{ url('/rakbuqu') }}">Rak Buqu</a></li>
                        <li style="margin-bottom: 10px; margin-left: -5px;">
                          <i class="fa fa-pen"> </i>
                          <a href="{{ url('/buqus/create') }}">Buat Buqu</a></li>
                    </ul>
                </li>

<div style="padding-bottom:25px"></div>
            </ul>
            <br/><br/><br/>
    </div>
  </div>
<div id="sidebar-overlay" onclick="sidebarBack();"></div>
  <!-- sidebar-mobile -->
        <div class="navbar-header nav-buttons">
            <button class="navbar-toggle collapsed pull-left" id="sidebar-button" onclick="sidebar()" style="padding-top:8px;">
                <span class="sr-only">Toggle Navigation</span>
                <span><i class="fa fa-bars fa-2x"></i></span>
            </button>
            <button type="button" class="btn navbar-toggle collapsed pull-left">
                <a href="{{ url('/kirim-tulisan') }}"><span><i class="fas fa-edit fa-2x"></i></span></a>
            </button>
            <button type="button" class="btn navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#app-navbar-collapse-profile" aria-expanded="false" aria-controls="app-navbar-collapse-profile">
              @if(Auth::check())
                <span class="navbar-avatar">
                  <img src="{{ URL::asset('uploads/avatar/'.Auth::user()->user_image) }}" onerror="avaError(this);" />
                </span>
              @else
                <a href="{{ url('/login') }}"><span><i class="fa fa-user fa-2x"></i></span></a>
              @endif
            </button>
            <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#app-navbar-collapse2" aria-expanded="false" aria-controls="app-navbar-collapse2" style="padding-top:7px;padding-right:28px;">
                @if(Auth::check())
                <span class="sr-only">Toggle Navigation</span>
                <span><i class="far fa-bell fa-2x"></i></span>
                @else
                <a href="{{ url('/login') }}"><span><i class="fa fa-bell-o fa-2x"></i></span></a>
                @endif
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('images/qureta-logo-square-small.png') }}" alt="Qureta" />
            </a>
        </div>
    </div>
    <div class="navbar-header scroll-topic" style="width:100%">
      <span style="margin-left:10px;">{{ HTML::link('/topik/politik', 'Politik')}}</span>
      {{ HTML::link('/topik/agama', 'Agama')}}
      {{ HTML::link('/topik/hiburan', 'Hiburan')}}
      {{ HTML::link('/topik/pendidikan', 'Pendidikan')}}
      {{ HTML::link('/topik/kuliner', 'Kuliner')}}
      {{ HTML::link('/topik/kesehatan', 'Kesehatan')}}
      {{ HTML::link('/topik/saintek', 'Saintek')}}
      {{ HTML::link('/topik/gaya-hidup', 'Gaya Hidup')}}
      <span style="margin-right:10px;">{{ HTML::link('/topik/wisata', 'Wisata')}}</span>
    </div>
    <!--notif for mobile-->
    <div class="collapse navbar-collapse" id="app-navbar-collapse2">
        @if(Auth::check())
        <?php $notifs = get_unread_notifications(Auth::user()->id); ?>
        @if(isset($notifs[0]))
        <ul class="nav navbar-nav">
          @foreach ($notifs as $notif)
            @if($notif->type === 'App\Notifications\NewPost')
              <li>
                <div>Tulisan baru</div>
                @if(isset($notif))
                  @component('components.article_box_small', ['row' => $notif->post])
                  @endcomponent
                @endif
              </li>

            @elseif($notif->type === 'App\Notifications\PublishPost')
              <li>
                <div>Tulisan terbit</div>
                @if(isset($notif))
                  @component('components.article_box_small', ['row' => $notif->post])
                  @endcomponent
                @endif 
            </li>
            @endif
          @endforeach
        </ul>
        @else
        <ul class="nav navbar-nav">
            <li>Tidak ada notifikasi baru</li>
        </ul>
        @endif
        @endif
    </div>
    <!--profile for mobile-->
    <div class="collapse navbar-collapse" id="app-navbar-collapse-profile">
      <ul class="nav navbar-nav">
          @if(Auth::check())
          <li>{{ HTML::link('/profile', Auth::user()->name)}}</li>
          <li>{{ HTML::link('/profile', 'Lihat Profil')}}</li>
          <li>{{ HTML::link('/password/change', 'Ubah Password')}}</li>
          <li>{{ HTML::link('/profile/edit', 'Edit Profil')}}</li>
          @if (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
          <li>{{ HTML::link('/admin', 'Administration')}}</li>
          @endif
          <li><a href="{{ url('/logout') }}"
             onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i> Logout
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form></li>
          @endif
      </ul>
    </div>
</nav>
