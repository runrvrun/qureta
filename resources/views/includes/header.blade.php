<!--default/mobile header-->
<div id="wrap" class="mobile-only">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#app-navbar-collapse1" aria-expanded="false" aria-controls="app-navbar-collapse1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span><i class="fa fa-bars fa-2x"></i></span>
                </button>            
                <button type="button" class="btn btn-danger navbar-toggle collapsed pull-left">
                    <a href="{{ url('/kirim-tulisan') }}"><span><i class="fa fa-pencil-square-o fa-2x"></i></span></a>
                </button>          
                <button type="button" class="btn navbar-toggle collapsed pull-right">
                    <a href="{{ url('/profile') }}"><span><i class="fa fa-user fa-2x"></i></span></a>                    
                </button>  
                <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#app-navbar-collapse2" aria-expanded="false" aria-controls="app-navbar-collapse2">                    
                    @if(Auth::check())
                    <span class="sr-only">Toggle Navigation</span>
                    <span><i class="fa fa-bell-o fa-2x"></i></span>
                    @else
                    <a href="{{ url('/login') }}"><span><i class="fa fa-bell-o fa-2x"></i></span></a>
                    @endif
                </button>  
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('images/qureta-logo.png') }}" alt="Qureta" />  
                </a>
            </div>                                              

            <!--menu for mobile-->
            <div class="collapse navbar-collapse" id="app-navbar-collapse1">
                <ul class="nav navbar-nav">                        
                    {!! Form::open(array('method'=>'GET', 'action'=>'QueryController@search', 'class'=>'form navbar-form searchform',  'id'=>'navBarSearchForm', 'role'=>'search')) !!}                        
                    <div class="input-group">
                        <input type="hidden" name="sp" value="artikel" id="search_param">  
                        <input type="text" class="form-control" placeholder="Cari artikel, penulis, atau buqu" name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}                     
                </ul>
                <ul class="nav navbar-nav"> 
                    @if (Auth::guest())
                    <li class="dropdown">
                        <a href="{{ url('/login') }}">Login</a>                    
                    </li>
                    <li class="nav-divider"></li>
                    @else
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="{{ url('/profile') }}" class="dropdown-toggle navbar-avatar" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ URL::asset('uploads/avatar/'.Auth::user()->user_image) }}" onerror="avaError(this);" />
                        </a>

                        <ul class="dropdown-menu" role="menu">        
                            <li><a href="{{ url('/profile') }}">
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <br/>View Profil
                                </a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/password/change') }}">Ubah Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/profile/edit') }}">Edit Profil</a></li>
                            <li role="separator" class="divider"></li>                        
                            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                            <li><a href="{{ url('/admin') }}">Administration</a></li>
                            <li role="separator" class="divider"></li>
                            @elseif (Auth::user()->role === 'partner')
                            <li><a href="{{ url('/admin/workshops') }}">Administration</a></li>
                            <li role="separator" class="divider"></li>
                            @endif
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    @endif 
                    <li class="dropdown">
                        <a href="{{ url('/kirim-tulisan') }}">Tulis Artikel</a> </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Artikel <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/tulisanku') }}">Tulisanku</a></li>
                            <li><a href="{{ url('/post/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/rekam') }}">Rekam</a></li>
                            <li><a href="{{ url('/jejak') }}">Jejak</a></li>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Penulis <span class="caret"></span></a>
                        <ul class="dropdown-menu">                            
                            <li><a href="{{ url('/penulis/terbaru') }}">Terbaru</a></li>
                            <li><a href="{{ url('/penulis/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/penulis/favorit') }}">Terfavorit</a></li>
                            <li><a href="{{ url('/penulis/produktif') }}">Terproduktif</a></li>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Buqu <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="{{ url('/buqu/pilihan') }}">Buqu Pilihan</a></li>
                            <li><a href="{{ url('/buqu/terpopuler') }}">Buqu Terpopuler</a></li>
                            <li><a href="{{ url('/rakbuqu') }}">Rak Buqu</a></li>
                            <li><a href="{{ url('/buqus/create') }}">Buat Buqu</a></li>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Topik <span class="caret"></span></a>
                        <ul class="dropdown-menu multi-column columns-4">
                            <div class="row">
                                <div class="col-xs-6">
                                    <ul class="dropdown">
                                        {{ HTML::link('/topik/agama', 'Agama')}}
                                        <br><br>
                                        {{ HTML::link('/topik/budaya', 'Budaya')}}<br><br>
                                        {{ HTML::link('/topik/buku', 'Buku')}}<br><br>
                                        {{ HTML::link('/topik/cerpen', 'Cerpen')}}<br><br>
                                        {{ HTML::link('/topik/ekonomi', 'Ekonomi')}}<br><br>
                                        {{ HTML::link('/topik/filsafat', 'Filsafat')}}<br><br>
                                        {{ HTML::link('/topik/gaya-hidup', 'Gaya Hidup')}} <br><br>
                                        {{ HTML::link('/topik/hiburan', 'Hiburan')}}<br><br>
                                        {{ HTML::link('/topik/hukum', 'Hukum')}}<br><br>
                                        {{ HTML::link('/topik/keluarga', 'Keluarga')}}<br><br>
                                        {{ HTML::link('/topik/kesehatan','Kesehatan')}}<br><br>
                                        {{ HTML::link('/topik/kuliner', 'Kuliner')}}
                                    </ul>
                                </div>
                                <div class="col-xs-6">
                                    <ul class="dropdown">
                                        {{ HTML::link('/topik/lingkungan', 'Lingkungan')}}<br><br>
                                        {{ HTML::link('/topik/media', 'Media')}}<br><br>
                                        {{ HTML::link('/topik/olahraga', 'Olahraga')}}<br><br>
                                        {{ HTML::link('/topik/pendidikan', 'Pendidikan')}}<br><br>
                                        {{ HTML::link('/topik/perempuan', 'Perempuan')}}<br><br>
                                        {{ HTML::link('/topik/politik', 'Politik')}}<br><br>
                                        {{ HTML::link('/topik/puisi', 'Puisi')}}<br><br>
                                        {{ HTML::link('/topik/saintek', 'Saintek')}}<br><br>
                                        {{ HTML::link('/topik/sejarah', 'Sejarah')}}<br><br>
                                        {{ HTML::link('/topik/seni', 'Seni')}}<br><br>
                                        {{ HTML::link('/topik/tip-and-trick', 'Tip&trik')}}<br><br>
                                        {{ HTML::link('/topik/wisata', 'Wisata')}}<br><br>
                                        {{ HTML::link('/semua-topik', 'SEMUA TOPIK')}}
                                    </ul>
                                </div>

                            </div>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Lomba Esai <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/lomba-esai') }}">Ikuti Lomba</a></li>
                            <li><a href="{{ url('/profile/qlomba?tulisanpage=1') }}">Info Lomba</a></li>
                            <li><a href="{{ url('/peserta-lomba-esai') }}">Peserta Lomba</a></li>
                        </ul>
                    </li>
                    <li class="nav-divider"></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Workshop <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/workshop') }}">Daftar Workshop</a></li>
                            <li><a href="{{ url('/profile/qworkshop?tulisanpage=1') }}">Info Workshop</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notif for mobile-->
            <div class="collapse navbar-collapse" id="app-navbar-collapse2">
                @if(Auth::check())
                <?php $notifs = get_unread_notifications(Auth::user()->id); ?>
                @if(isset($notifs[0]))
                <ul class="nav navbar-nav">
                    @foreach ($notifs as $notif)
                    @if($notif->type === 'App\Notifications\NewPost')
                    <li>{{ $notif->data['post_author'] }} memiliki tulisan baru: {{ HTML::link('/post/'.$notif->data['post_slug'],$notif->data['post_title']) }}</li>                        
                    @elseif($notif->type === 'App\Notifications\PublishPost')
                    <li class="notification">Selamat! Tulisan anda telah terbit: {{ HTML::link('/post/'.$notif->data['post_slug'],$notif->data['post_title']) }}</li>                        
                    @endif
                    @endforeach
                </ul>
                @else
                <ul class="nav navbar-nav">
                    <li>No new notification</li>
                </ul>
                @endif
                @endif
            </div>
        </div>
    </nav>
</div>     
<!--desktop header-->
<div id="wrap" class="desktop-only">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('images/qureta-logo.png') }}" alt="Qureta" />  
                </a>
            </div>                       

            <ul class="nav navbar-nav navbar-left">                        
                {!! Form::open(array('method'=>'GET', 'action'=>'QueryController@search', 'class'=>'form navbar-form searchform',  'id'=>'navBarSearchForm', 'role'=>'search')) !!}                        
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept"><span id="search_concept_icon" class="glyphicon glyphicon-file"></span></span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#artikel"> <span class="glyphicon glyphicon-file"></span> Artikel</a></li>
                            <li><a href="#penulis"> <span class="glyphicon glyphicon-user"></span> Penulis</a></li>
                            <li><a href="#buqu"> <span class="glyphicon glyphicon-book"></span> Buqu</a></li>                                        
                        </ul>
                    </div>
                    <input type="hidden" name="sp" value="artikel" id="search_param">  
                    <input type="text" class="form-control" placeholder="Cari artikel, penulis, atau buqu" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                {!! Form::close() !!}                     
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li style="padding-right: 10px;">
                    <p class="navbar-btn">
                        <a href="{{ url('/kirim-tulisan') }}" style="background-color: #EB4320;color: #fff;" class="btn btn-default">Tulis Artikel</a>
                    </p></li>
                @if (Auth::Check())
                <li><a href="{{ url('/messages') }}" class="notif"><i class="fa fa-envelope-o" style="font-size: 22px;"></i>
                        <?php $unread_message_count = Auth::user()->newThreadsCount(); ?>
                        @if($unread_message_count > 0)
                        <span class="message-badge">{{ $unread_message_count }}</span>
                        @endif
                    </a></li>
                <li class="dropdown">
                    <?php $notifs = get_unread_notifications(Auth::user()->id); ?>
                    <a href="#" class="notif dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="notif-button" data-userid="{{ Auth::user()->id }}" data-csrf_token="{{ csrf_token() }}">
                        <i class="fa fa-bell-o" style="font-size: 22px;"></i>
                        @if(count($notifs) > 0)
                        <span class="message-badge">{{ count($notifs) }}</span>
                        @endif
                    </a>
                    @if(isset($notifs[0]))
                    <ul class="dropdown-menu notification" role="menu">                        
                        @foreach ($notifs as $notif)
                        @if($notif->type === 'App\Notifications\NewPost')
                        <li>{{ $notif->data['post_author'] }} memiliki tulisan baru: {{ HTML::link('/post/'.$notif->data['post_slug'],$notif->data['post_title']) }}</li>                        
                        @elseif($notif->type === 'App\Notifications\PublishPost')
                        <li class="notification">Selamat! Tulisan anda telah terbit: {{ HTML::link('/post/'.$notif->data['post_slug'],$notif->data['post_title']) }}</li>                        
                        @endif
                        @endforeach
                    </ul>                    
                    @else
                    <ul class="dropdown-menu notification" role="menu">                        
                        <li>No new notification</li>
                    </ul>
                    @endif
                </li>
                @endif
                @if (Auth::guest())
                <li class="dropdown">
                    <a href="{{ url('/login') }}">Login</a>                    
                </li>
                @else
                <li class="dropdown">
                    <a href="{{ url('/profile') }}" class="dropdown-toggle navbar-avatar" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ URL::asset('uploads/avatar/'. Auth::user()->user_image ) }}" onerror="avaError(this);" />
                    </a>

                    <ul class="dropdown-menu" role="menu">        
                        <li><a href="{{ url('/profile') }}">
                                <strong>{{ Auth::user()->name }}</strong>
                                <br/>View Profil
                            </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('/password/change') }}">Ubah Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('/profile/edit') }}">Edit Profil</a></li>
                        <li role="separator" class="divider"></li>                        
                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                        <li><a href="{{ url('/admin') }}">Administration</a></li>
                        <li role="separator" class="divider"></li>
                        @elseif (Auth::user()->role === 'partner')
                        <li><a href="{{ url('/admin/workshops') }}">Administration</a></li>
                        <li role="separator" class="divider"></li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>           
        </div>
    </nav>
    <nav class="navbar navbar-default navbar-lower">
        <div class="container">
            <div class="collapse navbar-collapse" id="app-navbar-collapse3">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">     
                    @if(Auth::check())
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')       
                    <li class="dropdown">
                        <a href="{{ url('/post') }}">Artikel</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/tulisanku') }}">Tulisanku</a></li>
                            <li><a href="{{ url('/post/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/rekam') }}">Rekam</a></li>
                            <li><a href="{{ url('/jejak') }}">Jejak</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="{{ url('/post/populer') }}">Artikel</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/tulisanku') }}">Tulisanku</a></li>
                            <li><a href="{{ url('/post/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/rekam') }}">Rekam</a></li>
                            <li><a href="{{ url('/jejak') }}">Jejak</a></li>
                        </ul>
                    </li>
                    @endif
                    @elseif(!Auth::check())
                    <li class="dropdown">
                        <a href="{{ url('/post/populer') }}">Artikel</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/tulisanku') }}">Tulisanku</a></li>
                            <li><a href="{{ url('/post/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/rekam') }}">Rekam</a></li>
                            <li><a href="{{ url('/jejak') }}">Jejak</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown">Penulis</span></a>
                        <ul class="dropdown-menu dropdown-hover">                            
                            <li><a href="{{ url('/penulis/terbaru') }}">Terbaru</a></li>
                            <li><a href="{{ url('/penulis/populer') }}">Terpopuler</a></li>
                            <li><a href="{{ url('/penulis/favorit') }}">Terfavorit</a></li>
                            <li><a href="{{ url('/penulis/produktif') }}">Terproduktif</a></li>
                        </ul>
                    </li>                    

                    @if(Auth::check())
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <li class="dropdown">
                        <a href="{{ url('/buqu') }}">Buqu</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/buqu/pilihan') }}">Buqu Pilihan</a></li>
                            <li><a href="{{ url('/buqu/terpopuler') }}">Buqu Terpopuler</a></li>
                            <li><a href="{{ url('/rakbuqu') }}">Rak Buqu</a></li>
                            <li><a href="{{ url('/buqus/create') }}">Buat Buqu</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="{{ url('/buqu/pilihan') }}">Buqu</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/buqu/pilihan') }}">Buqu Pilihan</a></li>
                            <li><a href="{{ url('/buqu/terpopuler') }}">Buqu Terpopuler</a></li>
                            <li><a href="{{ url('/rakbuqu') }}">Rak Buqu</a></li>
                            <li><a href="{{ url('/buqus/create') }}">Buat Buqu</a></li>
                        </ul>
                    </li>
                    @endif
                    @elseif(!Auth::check())
                    <li class="dropdown">
                        <a href="{{ url('/buqu/pilihan') }}">Buqu</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/buqu/pilihan') }}">Buqu Pilihan</a></li>
                            <li><a href="{{ url('/buqu/terpopuler') }}">Buqu Terpopuler</a></li>
                            <li><a href="{{ url('/rakbuqu') }}">Rak Buqu</a></li>
                            <li><a href="{{ url('/buqus/create') }}">Buat Buqu</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="dropdown">
                        <a href="{{ url('/semua-topik') }}">Topik</a>
                        <ul class="dropdown-menu dropdown-hover  multi-column columns-4">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul class="multi-column-dropdown">
                                        <li>{{ HTML::link('/topik/agama', 'Agama')}}</li>
                                        <li>{{ HTML::link('/topik/budaya', 'Budaya')}}</li>
                                        <li>{{ HTML::link('/topik/buku', 'Buku')}}</li>
                                        <li>{{ HTML::link('/topik/cerpen', 'Cerpen')}}</li>
                                        <li>{{ HTML::link('/topik/ekonomi', 'Ekonomi')}}</li>
                                        <li>{{ HTML::link('/topik/filsafat', 'Filsafat')}}</li>

                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="multi-column-dropdown">
                                        <li>{{ HTML::link('/topik/gaya-hidup', 'Gaya Hidup')}}</li> 
                                        <li>{{ HTML::link('/topik/hiburan', 'Hiburan')}}</li>
                                        <li>{{ HTML::link('/topik/hukum', 'Hukum')}}</li>
                                        <li>{{ HTML::link('/topik/keluarga', 'Keluarga')}}</li>
                                        <li>{{ HTML::link('/topik/kesehatan', 'Kesehatan')}}</li>
                                        <li>{{ HTML::link('/topik/kuliner', 'Kuliner')}}</li>

                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="multi-column-dropdown">
                                        <li>{{ HTML::link('/topik/lingkungan', 'Lingkungan')}}</li>
                                        <li>{{ HTML::link('/topik/media', 'Media')}}</li>
                                        <li>{{ HTML::link('/topik/olahraga', 'Olahraga')}}</li>
                                        <li>{{ HTML::link('/topik/pendidikan', 'Pendidikan')}}</li>
                                        <li>{{ HTML::link('/topik/perempuan', 'Perempuan')}}</li>
                                        <li>{{ HTML::link('/topik/politik', 'Politik')}}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="multi-column-dropdown">
                                        <li>{{ HTML::link('/topik/puisi', 'Puisi')}}</li>
                                        <li>{{ HTML::link('/topik/saintek', 'Saintek')}}</li>
                                        <li>{{ HTML::link('/topik/sejarah', 'Sejarah')}}</li>
                                        <li>{{ HTML::link('/topik/seni', 'Seni')}}</li>
                                        <li>{{ HTML::link('/topik/tip-and-trick', 'Tip&trik')}}</li>
                                        <li>{{ HTML::link('/topik/wisata', 'Wisata')}}</li>


                                    </ul>
                                </div>
                            </div>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">                          
                    <li class="dropdown">
                        <a href="{{ url('/lomba-esai') }}">Lomba Esai</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/lomba-esai') }}">Ikuti Lomba</a></li>
                            <li><a href="{{ url('/profile/qlomba?tulisanpage=1') }}">Info Lomba</a></li>
                            <li><a href="{{ url('/peserta-lomba-esai') }}">Peserta Lomba</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ url('/workshop') }}">Workshop</a>
                        <ul class="dropdown-menu dropdown-hover">
                            <li><a href="{{ url('/workshop') }}">Daftar Workshop</a></li>
                            <li><a href="{{ url('/profile/qworkshop?tulisanpage=1') }}">Info Workshop</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>