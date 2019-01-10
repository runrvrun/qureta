<div class="author">
    @if(isset($options['follow_button']) && $options['follow_button'])
      @if(Auth::check())
        @if(Auth::user()->id != $row->id)
          <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
          @if (!isFollowing($row->id))
          <div style="float:right; z-index:30;">
              <button class="btn btn-xs btn-default btnFollowUser" data-target="{{ $row->id }}">
                  <i class="fas fa-user-plus"></i> Follow</button>
          </div>
          @endif
        @endif
      @endif
    @endif
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
    @if(isset($options['short_bio']) && $options['short_bio'])
      <blockquote style="font-size:12px">{{ get_user_short_bio($row->id) }} </blockquote>
    @endif
    <div style="padding:5px">
      @if(isset($options['post_count']) && $options['post_count'])
        <i class="far fa-file-alt"></i> {{ get_user_post_count($row->id) }} tulisan &middot;
      @endif
      @if(isset($options['view_count']) && $options['view_count'])
        <i class="fa fa-eye"></i> {{ number_format(get_user_view_count($row->id),0,',','.') }} views &middot;
      @endif
      @if(isset($options['follower']) && $options['follower'])
        <i class="far fa-user"></i> {{ number_format(get_user_follower_count($row->id),0,',','.') }} follower
      @endif
    </div>
    @if(isset($options['latest_post']) && $options['latest_post'])
      <div>
        <small>Tulisan terbaru:</small>
        <?php $latest_post = get_user_latest_post($row->id); ?>
        @if($latest_post)
          @component('components.article_box_noauthor', ['row' => $latest_post])
          @endcomponent
        @endif
      </div>
    @endif
</div>
<script>
    $(document).ready(function () {
      $('.btnFollowUser').unbind().click(function () {
          var $this = $(this);
          $this.toggleClass('active');
          var userid = $this.data("target");
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
