@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<!-- Adsense -->
<section id="adsensetop">
  @component('components.adsense')
  @endcomponent
</section>
<!-- / Adsense -->
<!-- Content -->
<section id="content">
    <div class="container" style="margin-top:20px;">
      <!-- Head Content -->
        <div class="main-content user-profile">
          <div class="column-two-third">
            <div class="author">
                @if(strpos($users->user_image,'ttps://') || strpos($users->user_image,'ttp://'))
                <div class="user-avatar" style="background-image: url('{{ $users->user_image }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
                </div>
                @else
                <div class="user-avatar" style="background: url('{{ URL::asset('/uploads/avatar/'.$users->user_image) }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
                </div>
                @endif
                <div class="user-name">{{ $users->name }}</div>
                @if(isset($users->role) && ($users->role == 'premium' || $users->role == 'partner' || $users->role == 'admin' || $users->role == 'editor'))
                <i class="verified-user"></i>
                @else
                <i class="unverified-user"></i>
                @endif
                <div class="user-profession">{{ get_user_profesi($users->id) }}</div>
                @if(isset($profile['short_bio']))
                <div class="user-info-bio">
                    {{ $profile['short_bio'] ?? ''}}
                </div>
                @endif
            </div>
          </div>
        </div>
        <div class="column-one-third">
          <div class="sidebar">
            <center style="float:left;">
                <a href="{{ url('/profile/followers/'.$users->username)}}">
                    <p style="margin:0px">Follower</p>
                    <p style="font-size:22px;">{{$jml_followers}}</p>
                </a>
            </center>
            <center>
                <a href="{{ url('/profile/following/'.$users->username)}}">
                    <p style="margin:0px">Following</p>
                    <p style="font-size:22px;">{{$jml_following}}</p>
                </a>
            </center>
            <div>
                @if(Auth::check()) @if(Auth::user()->id != $users->id)
                <input type="hidden" id="userid" value="{{ $users->id }}" />
                <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
                <input type="hidden" id="userid" value="{{ $users->id }}" />
                <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" /> @if (isFollowing($users->id))
                <div class="text-center">
                    <button class="btn-default" id="btnFollowUser" style="">
                        <i class="fa fa-check"></i> Following</button>
                </div>
                @else
                <div class="text-center">
                    <button class="btn-default" id="btnFollowUser" style="margin:auto">
                        <i class="fa fa-user-plus"></i> Follow</button>
                    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
                        <a href="{{ url('/profile/edit/'.$users->id) }}"><button class="btn-default" style="margin:auto">
                            <i class="fa fa-pencil"></i> Edit Profile</button></a>
                    @endif
                </div>
                @endif @endif @else
                <a href="{{url('/login')}}">
                    <button class="btn-default" style="" id="btnFollowUser">
                        <i class="fa fa-user-plus"></i> Follow</button>
                </a>
                @endif
                <div style="margin-top:10px;"></div>
            </div>
          </div>
        </div>
        <!-- Main Content -->
        <div class="main-content user-profile">
          <div class="column-two-third">
                <div class="outerwide">
                  <h5 class="line"><span>Tulisan {{ $users->name }}</span></h5>
                  @if(count($posts))
                  <ul class="block2">
                      @for ($i = 0; $i < count($posts); $i++)
                        <?php $row = $posts[$i]; ?>
                        @if ($i%2)
                          <li class="m-r-no">
                            @component('components.post_snip', ['row' => $row])
                            @endcomponent
                          </li>
                        @else
                          <li>
                            @component('components.post_snip', ['row' => $row])
                            @endcomponent
                          </li>
                        @endif
                      @endfor
                  </ul>
                  @endif
                </div>
            </div>
        </div>
        <!-- /Main Content, Article Result -->
        <!-- Sidebar, User Result -->
        <div class="column-one-third">
          <div class="sidebar">
            <h5 class="line"><span>Penulis Lainnya</span></h5>
              <div id="tabs">
                <ul style="display:none;">
                    <li><a href="#tabs1">Penulis</a></li>
                </ul>
                <div id="tabs1" style="border:none;padding:0;">
                  <ul>
                      @foreach ($terfavorit as $key=>$row)
                      <li>
                        @component('components.user', ['row' => $row])
                        @endcomponent
                      </li>
                      @endforeach
                  </ul>
                </div>
              </div>
          </div>
        </div>
        <!-- / Sidebar, User Result -->
    </div>
</section>
<!-- / Content -->
<!-- Adsense -->
<section id="adsensebottom">
  @component('components.adsense')
  @endcomponent
</section>
<!-- / Adsense -->
@endsection
@section('addfooter')
<script>
<script>
    $(document).ready(function () {
      $('#btnFollowUser').click(function () {
          var $this = $(this);
          $this.toggleClass('active');
          var userid = document.getElementById('userid').value;
          var followerid = document.getElementById('followerid').value;
          var token = '{{{ csrf_token() }}}';
          var data = {
              "_token": token,
              "userid": userid,
              "followerid": followerid
          };
          if ($this.hasClass('active')) {
              $.ajax({
                  url: "/user/follow",
                  type: "POST",
                  data: data,
                  error: function (exception) {
                      console.log(data)
                  },
                  success: function () {
                      $this.html('<i class="fa fa-check"></i> Following');
                  }
              });
          } else {
              $.ajax({
                  url: "/user/unfollow",
                  type: "POST",
                  data: data,
                  error: function (exception) {
                      console.log(data)
                  },
                  success: function () {
                      $this.html('<i class="fa fa-user-plus"></i> Follow');
                  }
              });
          }
      });
  });
</script>
@endsection
