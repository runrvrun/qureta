<header id="header">
    <div class="container">
        <div class="column">
            <div class="logo">
                <a href="/"><img src="{{ URL::asset('images/QuretaNew.png') }}" alt="Qureta" /></a>
            </div>


            @if(Auth::check())
            <div class="header-right">
              <a href="#" class="user-img" id="userbtn">
                <img src="{{ URL::asset('uploads/avatar/'.Auth::user()->user_image )}}" onerror="avaError(this);" />
                <div id="userdropdown" class="dropdown-content" style="width:200px;">
                    <ul class="block">
                      <li>Halo, <strong>{{ HTML::link('/profile/'.Auth::user()->username,Auth::user()->name)}}</strong></li>
                      <!--li>{{ HTML::link('/dashboard','Dashboard')}}</li-->
                      <li>{{ HTML::link('/profile/edit','Edit Profil')}}</li>
                      <li>{{ HTML::link('/password/change','Ganti Password')}}</li>
                      @if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor')
                      <li>{{ HTML::link('/admin','Administration')}}</li>
                      @endif
                      <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      </li>
                    </ul>
                </div>
              </a>
            </div>
            <div class="header-right dropdown">



                <?php $notifs = get_unread_notifications(Auth::user()->id); ?>
                <a href="#" class="btn btn-notif" id="notifbtn">
                    <i class="far fa-bell"></i>
                    @if(count($notifs) > 0)
                     <a class="badge1" data-badge="{{ count($notifs) }}"></a>
                   <!--<span class="message-badge"></span> -->
                    @endif
                </a>
                @if(isset($notifs[0]))
                <div id="notifdropdown" class="dropdown-content">
                  <div class="outertight smimg">
                    <ul class="block">
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
                  </div>
                </div>
                @else
                <div id="notifdropdown" class="dropdown-content">
                  Tidak ada notifikasi baru
                </div>
                @endif
              </a>
            </div>

            <div class="header-right">
              <a href="/messages" class="btn btn-message">

                <i class="far fa-envelope"></i>



              </a>

            </div>
            <div class="header-right">
              <a href="/kirim-tulisan" class="btn btn-kirim-tulisan hvr-sweep-to-right">
                Kirim Tulisan
                <i class="fa fa-pen-nib hvr-icon"></i>
              </a>
            </div>
            @else
            <div class="header-right">
              <a href="/login" class="btn btn-login hvr-sweep-to-right">
                Login
                <i class="fa fa-sign-in-alt"></i>
              </a>
            </div>
            <div class="header-right">
              <a href="/kirim-tulisan" class="btn btn-kirim-tulisan hvr-sweep-to-right">
                Kirim Tulisan
                <i class="fa fa-pen-nib hvr-icon"></i>
              </a>
            </div>
            @endif
            <div class="search">
                {!! Form::open(array('method'=>'GET', 'action'=>'QueryController@search', 'class'=>'navbar-form searchform',  'id'=>'navBarSearchForm', 'role'=>'search')) !!}
                    <input type="text" name="q" placeholder="Cari artikel atau penulis" class="ft"/>
                    <input type="submit" value="" class="fs">
                {!! Form::close() !!}
            </div>

            <!-- Nav -->
            <nav id="nav">
                <ul class="sf-menu">
                    <li class="{{ Request::is('/') ? 'current' : '' }}"><a href="/">Depan</a></li>
                    <li class="{{ Request::is('topik/politik') ? 'current' : '' }}"><a href="{{ url('/topik/politik') }}">Politik</a></li>
                    <li class="{{ Request::is('topik/ekonomi') ? 'current' : '' }}"><a href="{{ url('/topik/ekonomi') }}">Ekonomi</a></li>
                    <li class="{{ Request::is('topik/hukum') ? 'current' : '' }}"><a href="{{ url('/topik/hukum') }}">Hukum</a></li>
                    <li class="{{ Request::is('topik/saintek') ? 'current' : '' }}"><a href="{{ url('/topik/saintek') }}">Iptek</a></li>
                    <li class="{{ Request::is('topik/perempuan') ? 'current' : '' }}"><a href="{{ url('/topik/perempuan') }}">Perempuan</a></li>
                    <li class="{{ Request::is('topik/keluarga') ? 'current' : '' }}"><a href="{{ url('/topik/keluarga') }}">Keluarga</a></li>
                    <li class="{{ Request::is('topik/olahraga') ? 'current' : '' }}"><a href="{{ url('/topik/olahraga') }}">Olahraga</a></li>
                    <li class="{{ Request::is('topik/filsafat') ? 'current' : '' }}"><a href="{{ url('/topik/filsafat') }}">Filsafat</a></li>
                    <li class="{{ Request::is('topik') ? 'current' : '' }}"><a href="{{ url('/semua-topik') }}">Lainnya</a></li>
                </ul>

            </nav>
            <!-- /Nav -->
        </div>
    </div>
</header>
<!-- /Header -->
