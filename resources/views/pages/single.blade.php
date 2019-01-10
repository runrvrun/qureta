@extends('layouts.app')


@section('addhead')
<style>
.banner-inside-article{
  margin: 0 auto;
  margin: 10px 0 15px 0;
}
.banner-inside-article>a>img{
  width: 50%;
}
</style>
@endsection

@section('content')
<section id="content">
    <div class="container">
      <div class="main-content">
          <!-- Single -->
          <div class="column-two-third single">
            @if( $post->post_status !== 'publish' )
            <div class="alert alert-warning">
                Post status: {{ $post->post_status }}
            </div>
            @endif
            @if(Auth::check())
              <div style="margin-bottom:20px;">
                <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
                @if(Auth::user()->id == $post->post_author && $post->post_status === 'draft')
                <a href="{{ url('/edit-tulisan/'.$post->post_slug) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit Tulisan</a>
                @elseif ((Auth::user()->id == $post->post_author && (Auth::user()->role === 'premium' || Auth::user()->role === 'partner') || Auth::user()->role === 'admin' || Auth::user()->role === 'editor'))
                <a href="{{ url('/edit-tulisan/'.$post->post_slug) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit Tulisan</a>
                @endif
                @if(Auth::user()->role=='admin')
                    {!! Form::open([
                        'method'=>'post_title',
                        'url' => ['/api/send-notification'],
                        'style' => 'display:inline'
                    ]) !!}
                    {!! Form::hidden('title',$post->post_title) !!}
                    {!! Form::hidden('body',substr(strip_tags($post->post_content),0,200)) !!}
                    {!! Form::hidden('url',$post->post_slug) !!}
                        {!! Form::button('<span class="fa fa-exclamation-sign" aria-hidden="true" title="Push Notification"></span> Push Notification', array(
                                'type' => 'submit',
                                'class' => 'btn btn-warning',
                                'title' => 'Delete Post',
                                'onclick'=>'return confirm("Send push notification? (Do not send too often)")'
                        )) !!}
                    {!! Form::close() !!}
                @endif
              </div>
            @endif

            @component('components.post_author',['row' => $post])
            @endcomponent
            <?php $topik = get_post_topik($post->id)  ?>
            <span class="meta" style="text-align:left;">{{ ($post->published_at)? $post->published_at->diffForHumans():$post->post_status }} &middot; <i class="fa fa-eye"></i> {{ $post ->view_count }} view &middot; <i class="fa fa-clock"></i> {{read_time($post ->post_content)}} menit baca &middot;
              @if($topik)
              <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a>
              @endif
            </span>
            <div class='col-xs-10 shareaholic-canvas' data-link='{{ $post->post_slug }}' data-image="{{URL::asset('/uploads/post/'.$post->post_image)}}" data-app='share_buttons' data-app-id='26649626' data-summary='QURETA | {{$post->post_authors->name}}'></div>

            <img class="article-featured-img" src="{{ URL::asset('/uploads/post/'.$post->post_image) }}" alt="{{ $post->post_image }}" onerror="imgError(this);" />
            @if(!empty($post->post_image_credit))
            <div class="post-image-credit"><small>{{ $post->post_image_credit }}</small></div>
            @endif
            <div class="article-single title">
                <h1>{!! $post->post_title !!} <small>{!! $post->post_subtitle ? '<br/>'.$post->post_subtitle : '' !!}</small></h1>
                <input type="hidden" id="postid" value="{{ $post->id }}" />
            </div>

            <div class="article-single content @if(!Auth::check() && $post->require_login) require-login @endif">
                {!! $post->post_content !!}
            </div>
                @if(!Auth::check() && $post->require_login)
            	<div class="require-login-box well text-center">
              	<p><strong>Daftar menjadi anggota Qureta untuk membaca tulisan eksklusif <br> {!! $post->post_title !!} karya {!! $post->post_authors->name !!}</strong></p>
              	<a href="{{ url('/register') }}" class="btn btn-success btn-lg btn-block"> Daftar </a>
              	<p><small>Sudah menjadi anggota Qureta? {{ HTML::link('/login','Log in') }}</small></p>
              </div>
                @endif
            <hr/>
            <div class='col-xs-10 shareaholic-canvas' data-link='{{ $post->post_slug }}' data-image="{{URL::asset('/uploads/post/'.$post->post_image)}}" data-app='share_buttons' data-app-id='26649626' data-summary='QURETA | {{$post->post_authors->name}}'></div>
            @if(!$post->hide_adsense)
                @component('components.adsense')
                @endcomponent
            @endif
            <div class="fb-comments" data-href="v3.qureta.com/post/{{ $post->post_slug }}" data-numposts="5"></div>
            <div class="row text-center">
              <a class="btn btn-default btn-block" id="unsub" style="display:none;margin-top:12px">Unsubscribe Notification</a>
            </div>

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
                  @foreach ($terfavorit as $key=>$row)
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
    </div>
</section>
@endsection



@section('addfooter')
<!-- modal box for push notif request -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function cookies_enabled()
{
    var cookieEnabled = (navigator.cookieEnabled) ? true : false;

    if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
    {
        document.cookie = "testcookie";
        cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
    }
    return (cookieEnabled);
}
</script>
<script>
$(document).ready(function (e) {
    //count view
    var postid = document.getElementById('postid').value;
    var token = '{{{ csrf_token() }}}';
    var data = {"_token": token, "id": postid};
    if (cookies_enabled()) {
        if ($.cookie("qureta_view_" + postid)) {
            // cookie exist, already count view, do nothing
        } else {
            // add share counter
            $.ajax({
                url: "/post/incrementviewcounter",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                  var date = new Date();
                  var minutes = 5;//cookie expire in 60 minutes
                  date.setTime(date.getTime() + (minutes * 60 * 1000));
                  $.cookie("qureta_view_" + postid, postid, {expires: date});
                }
            });
        }
    }
    //froala inline image default center
    //have to do this in JS because there is no way to select parent in CSS
    $('.fr-dib').parent().css({
        'text-align' : 'center'
    });
        //fix youtube iframe cropped
        if (window.screen.availWidth < 640) {
            $('iframe').width('100%');
        }
    });

    $('#btnaddtobuqu').click(function () {
        $('#modaladdbuqu').modal('hide');
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "post_id": $('input[name=addtobuqu_postid]').val(), "buqu_id": $('select[name=addtobuqu_buquid] :selected').val()};
        $.ajax({
            url: "/buqu_posts/createajax",
            type: "POST",
            data: data,
            error: function (exception) {
                console.log(data)
            },
            success: function (data) {
              $('#modalsuccessbuqubody').html('<p>Artikel telah ditambahkan ke buqu <strong>' + data['buqu_title'] + '</strong> [<a href="/buqu/' + data['buqu_slug'] + '">Lihat Buqu</a>]</p>');
              $('#modalsuccessbuqu').modal('show');
            }
        });
    });

    //show push notification request when finish reading
    var reachendonce = false;
    $(window).scroll(function(){
      // detect if the element is scrolled into view
      function elementScrolled(elem)
      {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $(elem).offset().top;
        return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
      }

      function getCookie(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(';');
          for(var i = 0; i <ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) == ' ') {
                  c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
              }
          }
          return "";
      }
      var dontaskagain = getCookie('dontaskagain');
      if(reachendonce==false && elementScrolled('#endofpost') && dontaskagain !== "true" && Notification.permission !== "granted") {
          reachendonce = true;
          // push notification
          setTimeout(function () {
            $.confirm({
              theme: 'modern',
              icon: 'fa fa-question',
              closeIcon: 'true',
              animation: 'scale',
              type: 'blue',
              title: 'Suka artikel di Qureta?',
              content: 'Berlangganan notifikasi untuk mendapat informasi artikel terbaru'+
              '<br/><br/><div class="checkbox"><label><input type="checkbox" id="dontaskagain"> Jangan tanya lagi</label></div>',
              backgroundDismiss: true,
              buttons: {
                 ya: {
                           text: 'Ya, tentu!',
                           btnClass: 'btn-blue',
                           keys: ['enter', 'shift'],
                           action: function(){
                               registerServiceWorker();
                               askPermission();
                               subscribeUserToPush();
                           }
                       },
                   lainkali: {
                             text: 'Lain kali',
                             action: function(){
                                 var $dontaskagain = this.$content.find('#dontaskagain');
                                 //if dontaskagain, insert to cache, check cache before showing prompt
                                 if($dontaskagain.prop('checked')){
                                     document.cookie = "dontaskagain=true; expires=Thu, 18 Dec 2099 12:00:00 UTC; path=v3.qureta.com";
                                 }
                             }
                         }
              }
          });
        }, 10000);
      }
    });

    var isSubscribed = false;
    $(document).ready(function (e) {
      // get subscription value
      return navigator.serviceWorker.register('/js/sw.js?v=6')
      .then(function(registration) {
          registration.pushManager.getSubscription()
            .then(function(subscription) {
              isSubscribed = !(subscription === null);
              //show unsubscribe button
              if (isSubscribed) {
                $("#unsub").text('Unsubscribe Notification');
              } else {
                $("#unsub").text('Subscribe Notification');
              }
              $("#unsub").css('display','block');
            });
          //handle unsubscribe/subscribe button click
          $("#unsub").click(function () {
            if (isSubscribed) {
              unsubscribeUserFromPush();
            } else {
              subscribeUserToPush();
            }
          });
        });
    });


    function registerServiceWorker() {
      return navigator.serviceWorker.register('/js/sw.js?v=4')
      .then(function(registration) {
        console.log('Service worker successfully registered.');
        return registration;
      })
      .catch(function(err) {
        console.error('Unable to register service worker.', err);
      });
    }
    function askPermission() {
      return new Promise(function(resolve, reject) {
        const permissionResult = Notification.requestPermission(function(result) {
          resolve(result);
        });

        if (permissionResult) {
          permissionResult.then(resolve, reject);
        }
      })
      .then(function(permissionResult) {
        if (permissionResult !== 'granted') {
          throw new Error('We weren\'t granted permission.');
        }
      });
    }
    function subscribeUserToPush() {
      return navigator.serviceWorker.register('/js/sw.js?v=4')
      .then(function(registration) {
        const subscribeOptions = {
          userVisibleOnly: true,
          applicationServerKey: urlBase64ToUint8Array(
            "{{env('VAPID_PUBLIC_KEY')}}"
          )
        };
        console.log("vapid public key: {{env('VAPID_PUBLIC_KEY')}}");
        return registration.pushManager.subscribe(subscribeOptions);
console.log(registration.pushManager.getSubscription());
      })
      .then(function(pushSubscription) {
        console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
        sendSubscriptionToBackEnd(JSON.parse(JSON.stringify(pushSubscription)));
        isSubscribed = true;
        $("#unsub").text('Unsubscribe Notification');
        return pushSubscription;
      });
    }
    function unsubscribeUserFromPush() {
      console.log('Unsubscribing...');
      return navigator.serviceWorker.register('/js/sw.js?v=4')
      .then(function(registration) {
        registration.pushManager.getSubscription()
        .then(function(subscription) {
          if (subscription) {
            return subscription.unsubscribe();
          }
        })
        .catch(function(error) {
          console.log('Error unsubscribing', error);
        })
        .then(function() {
          console.log('User is unsubscribed.');
          isSubscribed = false;
          $("#unsub").text('Subscribe Notification');
        });
      });
    }
    function urlBase64ToUint8Array(base64String) {
      const padding = '='.repeat((4 - base64String.length % 4) % 4);
      const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

      const rawData = window.atob(base64);
      const outputArray = new Uint8Array(rawData.length);

      for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
      }
      return outputArray;
    }
    function sendSubscriptionToBackEnd(subscription) {
      var userid = {{ (Auth::check())? Auth::user()->id:4100}};
      var endpoint = subscription.endpoint;
      var publickey = subscription.keys.p256dh;
      var authtoken =  subscription.keys.auth;
      var token = '{{{ csrf_token() }}}';
      var data = {"_token": token, "user_id": userid, "endpoint": endpoint, "public_key": publickey, "auth_token": authtoken};

      $.ajax({
          url: "/api/save-subscription",
          type: "POST",
          data: data,
          error: function (exception) {
              console.log(data)
          },
          success: function () {
              console.log("Subscription successfully saved to backend.")
          }
      });
}
</script>
@endsection
