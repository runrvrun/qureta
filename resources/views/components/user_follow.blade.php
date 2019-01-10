<div class="author" style="float:left">

    @if(strpos($row->user_image,'ttps://')  || strpos($row->user_image,'ttp://')  )

    <div class="author-image"
         style="background-image: url('{{ $row->user_image }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
    </div>

    @else
    <div class="author-image"
         style="background: url('{{ URL::asset('/uploads/avatar/'.$row->user_image) }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
    </div>

    @endif
    <div style="display:-webkit-box">
      <div class="author-name">{{ HTML::link('profile/'.$row->username,$row->name) }}</div>
      @if(isset($row->role) && ($row->role == 'premium' || $row->role == 'partner' || $row->role == 'admin' || $row->role == 'editor'))
      <i class="verified-user"></i>
      @else
      <i class="unverified-user"></i>
      @endif
    </div>
    <div class="author-profession">{{ get_user_profesi($row->id) }}</div>
</div>
@if(Auth::check())
  @if(Auth::user()->id != $row->id)
    @if (!isFollowing($row->id))
    <div style="float:right; z-index:30;">
        <button class="btn btn-xs btn-default btnFollowUser" data-userid="{{ $row->id }}" data-followerid="{{ Auth::user()->id }}">
            <i class="fas fa-user-plus"></i> Follow</button>
    </div>
    @endif
  @endif
@endif
<script>
    $(document).ready(function () {
      $('.btnFollowUser').unbind().click(function () {
          var $this = $(this);
          $this.toggleClass('active');
          var userid = $this.data("userid");
          var followerid = $this.data("followerid");
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
                      console.log('follow success')
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
                      console.log('unfollow success')
                      $this.html('<i class="fa fa-user-plus"></i> Follow');
                  }
              });
          }
      });
  });
</script>
