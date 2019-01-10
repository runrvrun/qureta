<script>
function avaError(image) {
    image.onerror = "";
    image.src = "/uploads/avatar/noavatar.jpg";
    return true;
}
</script>
<style>
.scroll-topic {
  white-space: nowrap;
  overflow-x: scroll; // scroll
  -webkit-overflow-scrolling: touch;
  background-color: green;
  line-height: 34px;
}
.scroll-topic a{
  color:#fff;
  margin: 5px;
}
#app-navbar-collapse-profile ul>li{
  margin: 10px 20px;
  
}
#app-navbar-collapse-profile ul>li a{
  color:#333;
  font-weight: normal;
  border-bottom:1px solid   #C0C0C0;
}
</style>
<!--default/mobile header-->
<div id="wrap" class="mobile-only">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
			<!-- sidebar-mobile -->
			<div id="sidebar-mobile">
				<ul class="nav navbar-nav" style="margin:7.5px -15px 0px -15px !important;">
					<button class="navbar-toggle collapsed pull-left" id="sidebar-button-back" onclick="sidebarBack()">
						<i style="font-size:20px;padding-left:5px;" class="glyphicon glyphicon-arrow-left"></i>
					</button>
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
				<!--<ul class="nav navbar-nav">
                    {!! Form::open(array('method'=>'GET', 'action'=>'QueryController@search', 'class'=>'form navbar-form searchform',  'id'=>'navBarSearchForm', 'role'=>'search')) !!}
                    <div class="input-group">
                        <input type="hidden" name="sp" value="artikel" id="search_param">
                        <input type="text" class="form-control" placeholder="Cari artikel, penulis, atau buqu" name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </ul>-->
				<div class="container-sidebar-mobile">

				</div>
			</div>
<div id="sidebar-overlay" onclick="sidebarBack();"></div>
			<!-- sidebar-mobile -->
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#app-navbar-collapse1" aria-expanded="false" aria-controls="app-navbar-collapse1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span><i class="fa fa-bars fa-2x"></i></span>
                </button> -->
				<button class="navbar-toggle collapsed pull-left" id="sidebar-button" onclick="sidebar()">
                    <span class="sr-only">Toggle Navigation</span>
                    <span><i class="fa fa-bars fa-2x"></i></span>
                </button>
                <button type="button" class="btn btn-danger navbar-toggle collapsed pull-left">
                    <a href="{{ url('/kirim-tulisan') }}"><span><i class="fa fa-pencil-square-o fa-2x"></i></span></a>
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
                    <img src="{{ URL::asset('images/qlogonew.png') }}" alt="Qureta" />
                </a>
            </div>
            <div class="navbar-header scroll-topic" >
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

			<script type="text/javascript">
			function sidebar(){
				$('#sidebar-mobile').removeClass('animate-sidebar-back');
				$('#sidebar-overlay').removeClass('overlay-deactive');
				$('#sidebar-mobile').addClass('animate-sidebar');
				$('#sidebar-overlay').addClass('overlay-active');
			}
			function sidebarBack(){
				$('#sidebar-mobile').removeClass('animate-sidebar');
				$('#sidebar-overlay').removeClass('overlay-active');
				$('#sidebar-overlay').addClass('overlay-deactive');
				$('#sidebar-mobile').addClass('animate-sidebar-back');
				setTimeout(function() {
					$('#sidebar-overlay').removeClass('overlay-deactive');
				}, 260);
			}
			</script>
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
                      Logout
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form></li>
                  @endif
              </ul>
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
                    <img src="{{ URL::asset('images/qureta-long.png') }}" alt="Qureta" />
                </a>
            </div>

            {{-- <ul class="nav navbar-nav navbar-left">
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
            </ul> --}}


            <!-- Right Side Of Navbar -->

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle navbar-avatar" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ URL::asset('uploads/avatar/'. Auth::user()->user_image ) }}" onerror="avaError(this);" />
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/profile/'.Auth::user()->username) }}">
                                <strong>{{ Auth::user()->name }}</strong>
                                <br/>Lihat Profil
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
                        <li><a href="{{ url('/admin/workshops') }}">Workshop</a></li>
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
            </ul>
        </div>
    </nav>
</div>
