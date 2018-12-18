@extends('layouts.app')

@section('title')
- Kirim Tulisan
@endsection

@section('addhead')
@include('includes.wysiwyg_head')
@endsection

@section('content')
<section id="content">
    <div class="container">
      @if (isset($post))
        {!! Form::model($post, [ 'method' => 'PATCH','onsubmit' => 'saveTerkait()' ,'url' => ['/posts', $post->id], 'id' =>'postform', 'class' => 'form-horizontal', 'files'=> true ]) !!}
        {!! Form::hidden('post_id', $post->id) !!}
        {!! Form::hidden('post_status', $post->post_status) !!}
      @else
        {!! Form::open(['url' => '/posts', 'class' => 'form-horizontal', 'id' =>'postform', 'files' => true]) !!}
        {!! Form::hidden('_method', 'POST') !!}
        {!! Form::hidden('post_status', 'draft') !!}
        {!! Form::hidden('view_count', 0) !!}
        {!! Form::hidden('share_count', 0) !!}
        {!! Form::hidden('like_count', 0) !!}
        {!! Form::hidden('comment_status', 'open') !!}
        {!! Form::hidden('post_slug', '') !!}
      @endif
    	<!-- Main Content -->
        <div class="main-content single-article">
            <!-- Single -->
            <div class="column-two-third single">
              <div class="user-info">
                  @component('components.user', ['row' => Auth::user()])
                  @endcomponent
                  <span style="text-align:left;" class="meta"></span>
              </div>
              <input type="image" id="article-featured-img" class="article-featured-img" src="{{ URL::asset('/uploads/post/')}}{{ $post->post_image ?? '' }}" onerror="imgError(this);" />
              <input type="file" id="post_image" name="post_image" style="display: none;" />
              <div><input type="text" name="post_image_credit" placeholder="Photo credit"  value="{{ $post->post_image_credit ?? ''}}" /></div>
              <div style="line-height:35px;">
                <input type="text" name="post_title" class="article-title" placeholder="Judul tulisan" value="{{ $post->post_title ?? ''}}" />
                {!! $errors->first('post_title', '<p class="help-block error">:message</p>') !!}
              </div>
              <div style="line-height:25px;margin-bottom:15px;"><input type="text" name="post_subtitle"  value="{{ $post->post_subtitle ?? ''}}" class="article-subtitle" placeholder="Subjudul (opsional)" /></div>
              <div class="article-single content form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                  {!! Form::textarea('post_content', null, ['class' => 'form-control wysiwygeditor','id' => 'content-paragraph']) !!} {!! $errors->first('post_content','<p class="help-block">:message</p>') !!}
              </div>
              <!-- Artikel Terkait dan Banner -->
              @if(@isset($post) && (Auth::user()->role === 'admin' || Auth::user()->role === 'editor'))
              <?php
              //convert data related artikel dari json ke array
              if( isset($related) )
              {
                  $related = json_decode($related,true);
                  $at1 = $related[0]['at'] != '-' ? $related[0]['at'] : '' ;
                  $at2 = $related[1]['at'] != '-' ? $related[1]['at'] : '' ;
                  $at3 = $related[2]['at'] != '-' ? $related[2]['at'] : '' ;
                  $id1 = $related[0]['id'] != '-' ? $related[0]['id'] : 0 ;
                  $id2 = $related[1]['id'] != '-' ? $related[1]['id'] : 0 ;
                  $id3 = $related[2]['id'] != '-' ? $related[2]['id'] : 0 ;
              }
              else
              {
                  $at1 =  '';
                  $at2 = '';
                  $at3 = '';
                  $id1 = '';
                  $id2 = '';
                  $id3 = '';
              }
              //convert data banner inside article dari json ke array
              if( isset($banner_inside_article) )
              {
                  $banner_inside_article = json_decode($banner_inside_article,true);
              }
              ?>
              <!-- artikel terkait -->
              <div class="artikel-terkait-box" style="margin-bottom:10px; margin-top:30px;">
                  <center>
                      <a class="btn btn-default artikel-slide-btn">Artikel Terkait</a>
                  </center>
                  <div class="form-group slide-artikel-terkait">
                      {{ Form::hidden('id', $post->id,array('id'=>'idPost')) }}
                      <div style="text-align: center; padding: 5px 0;">
                        <input class="form-control input-sm" type="number" name="paragraphTerkait1" id="paragraphTerkait1" value="{{ $at1 }}" placeholder="paragraph" min="1" style="width:40px;" />
                        <input name="ArtikelTerkait1" id="ArtikelTerkait1" value="{{ App\Post::where('id', $id1)->value('post_title') }}" type="text" class="form-control input-sm" placeholder="Artikel Terkait" style="width:440px;" />
                        <input value="{{ $id1 }}" id="ArtikelTerkait1id" name="ArtikelTerkait1id" type="hidden">
                      </div>
                      <div style="text-align: center; padding: 5px 0;">
                        <input class="form-control input-sm" type="number" name="paragraphTerkait2" id="paragraphTerkait2" value="{{ $at2 }}" placeholder="paragraph" min="1" style="width:40px;" />
                        <input name="ArtikelTerkait2" id="ArtikelTerkait2" value="{{ App\Post::where('id', $id2)->value('post_title') }}" type="text" class="form-control input-sm" placeholder="Artikel Terkait" style="width:440px;" />
                        <input value="{{ $id2 }}" id="ArtikelTerkait2id" name="ArtikelTerkait2id" type="hidden">
                      </div>
                      <div style="text-align: center; padding: 5px 0;">
                        <input class="form-control input-sm" type="number" name="paragraphTerkait3" id="paragraphTerkait3" value="{{ $at3 }}" placeholder="paragraph" min="1" style="width:40px;" />
                        <input name="ArtikelTerkait3" id="ArtikelTerkait3" value="{{ App\Post::where('id', $id3)->value('post_title') }}" type="text" class="form-control input-sm" placeholder="Artikel Terkait" style="width:440px;" />
                        <input value="{{ $id3 }}" id="ArtikelTerkait3id" name="ArtikelTerkait3id" type="hidden">
                      </div>
                  </div>
              </div>
              <!-- banner inside_article -->
              <div class="artikel-terkait-box" style="margin-bottom:10px;">
                  <center>
                      <a class="btn btn-default banner-inside-article-slide-btn">Banner</a>
                  </center>
                  <div class="form-group slide-banner-inside-article">
                    {{ Form::hidden('id', $post->id,array('id'=>'idPost')) }}
                    <div style="text-align: center; padding: 5px 0;">
                      <input name="banner_inside_article[0][at]" value="{{ $banner_inside_article[0]['at'] ?? '' }}" class="form-control input-sm" type="number" placeholder="paragraph" style="width:40px;" />
                      {{ Form::select('banner_inside_article[0][id]', \App\Banner::where('position','inside_article')->where('show_end','>',Carbon::now())->orwhere('show_end','')->pluck('name','id'),$banner_inside_article[0]['id'] ?? null,['class' => 'form-control']) }}
                    </div>
                    <div style="text-align: center; padding: 5px 0;">
                      <input name="banner_inside_article[1][at]" value="{{ $banner_inside_article[1]['at'] ?? '' }}" class="form-control input-sm" type="number" placeholder="paragraph" style="width:40px;" />
                      {{ Form::select('banner_inside_article[1][id]', \App\Banner::where('position','inside_article')->where('show_end','>',Carbon::now())->orwhere('show_end','')->pluck('name','id'),$banner_inside_article[1]['id'] ?? null,['class' => 'form-control']) }}
                    </div>
                    <div style="text-align: center; padding: 5px 0;">
                      <input name="banner_inside_article[2][at]" value="{{ $banner_inside_article[2]['at'] ?? '' }}" class="form-control input-sm" type="number" placeholder="paragraph" style="width:40px;" />
                      {{ Form::select('banner_inside_article[2][id]', \App\Banner::where('position','inside_article')->where('show_end','>',Carbon::now())->orwhere('show_end','')->pluck('name','id'),$banner_inside_article[2]['id'] ?? null,['class' => 'form-control']) }}
                    </div>
                  </div>
              </div>
              @endif
              <!-- / Artikel Terkait dan Banner -->
            </div>
            <!-- /Single -->

        </div>
        <!-- /Main Content -->

        <!-- Left Sidebar -->
        <div class="column-one-third">
        	<div class="sidebar floating" style="padding-top:50px;">
            <!-- Alerts -->
            @if (Session::has('flash_message'))
            <div class="alert alert-success" role="alert">
                <p>{!! Session::get('flash_message') !!}</p>
            </div>
            @endif
            <!-- / Alerts -->
            @if ($draftcount > 0)
            <div>{!! HTML::link('/tulisanku/draft','Draft Tulisan ('.$draftcount.')') !!}</div>
            @endif
            <div>Status: <strong>{{ $post->post_status ?? 'DRAFT' }}</strong></div>
            <div>Topik: {!! Form::select('post_category', get_dd_categories(), $category ?? null, ['class' => 'form-control']) !!}</div>
            @if(isset($competition))
            <div class="form-group">
                <label>Lomba</label>
                {!! Form::select('post_competition', get_dd_competition($competition->competition->id), $competition->competition->id, ['class' => 'form-control']) !!}
            </div>
            @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
            <div class="form-group">
                <label>Lomba:</label>
                {!! Form::select('post_competition', get_dd_competition(), null, ['class' => 'form-control']) !!}
            </div>
            @endif
            @if(Auth::user()->role === 'admin' || Auth::user()->role=== 'editor')
              {!! Form::checkbox('hide', null, null) !!} Sembunyikan <br/>
              {!! Form::checkbox('require_login', null, null) !!} Require Login <br/>
              {!! Form::checkbox('sticky', null, null) !!} Sticky <br/>
              {!! Form::checkbox('hide_adsense', null, null) !!} Hide Adsense <br/>
            @endif
            @if(isset($post->feedback_editor))
            <div>
              Feedback editor:<br/>
              {{ $post->feedback_editor }}
            </div>
            @endif
            @if(!isset($post))
              <!-- buttons for create -->
              <div class="kirimtulisan-sidebar-btn"><a name="save" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-save"></i> Simpan</a></div>
              <div class="kirimtulisan-sidebar-btn"><a name="savepending" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-paper-plane"></i> Kirim ke Editor</a></div>
            @else
              <!-- buttons for edit -->
              @if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor')
                <!-- buttons for edit for editor/admin -->
                @if($post->post_status == 'pending')
                  <textarea name="feedback_editor"></textarea>
                  <div class="kirimtulisan-sidebar-btn"><a name="savedraft" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-share-square"></i> Kembalikan ke Penulis</a></div>
                @endif
                <div class="kirimtulisan-sidebar-btn"><a name="save" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-save"></i> Simpan</a></div>
                <div class="kirimtulisan-sidebar-btn"><a name="delete" class="btn btn-primary" onclick="return confirm("Hapus tulisan? Tulisan yang dihapus tidak dapat dikembalikan"); $('#postform').submit()"><i class="fa fa-trash"></i> Hapus Tulisan</a></div>
                @if($post->post_status != 'publish')
                  <div class="kirimtulisan-sidebar-btn"><a name="savepublish" class="btn btn-primary" onclick="return confirm("Terbitkan tulisan ini?");$('#postform').submit();"><i class="fa fa-paper-plane"></i> Terbitkan</a></div>
                  <div class="kirimtulisan-sidebar-btn">Terbitkan pada {!! Form::input('text', 'published_at', ($post->published_at != null) ? $post->published_at->format('d-m-Y H:i') : Carbon::now()->format('d-m-Y H:i'), ['id'=>'publish-at','class' => 'form-control'])!!}</div>
                @endif
              @elseif (Auth::user()->role == 'premium')
                <!-- buttons for edit for premium -->
                <a name="save" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-save"></i> Simpan</a>
              @else
                <!-- buttons for edit for author -->
                @if($post->post_status !== 'publish')
                  <a name="save" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-save"></i> Simpan</a>
                  <div class="kirimtulisan-sidebar-btn"><a name="savepending" class="btn btn-primary" onclick="$('#postform').submit()"><i class="fa fa-paper-plane"></i> Kirim ke Editor</a></div>
                @endif
                <div class="kirimtulisan-sidebar-btn"><a name="delete" class="btn btn-primary" onclick="return confirm("Hapus tulisan? Tulisan yang dihapus tidak dapat dikembalikan"); $('#postform').submit()"><i class="fa fa-trash"></i> Hapus Tulisan</a></div>
              @endif
            @endif
            <small id="autosavenotify" class="pull-right"></small>
          </div>
        </div>
        <!-- /Left Sidebar -->
        {!! Form::close() !!}
    </div>
</section>
@endsection

@section('addfooter')
@include('includes.wysiwyg_footer')
<script>
/* Image Preview --> */
function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
             $('#article-featured-img').attr('src', e.target.result);
         }

         reader.readAsDataURL(input.files[0]);
     }
 }

 $("#post_image").change(function(){
     readURL(this);
 });

$(function() {

    var $sidebar   = $(".sidebar"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 10;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });

});

$("input[type='image']").click(function() {
    $("input[name='post_image']").click();
    return false;
});
</script>
<script>
    //autosave draft
    //do not autosave if save button is not visible
    var cansave = $('input[name=save]');
    if (cansave.length > 0) {
        var autosaveOn = false;
        var postid = $('input[name=post_id]').val();
        var poststatus = $('input[name=post_status]').val();
        var method = 'POST';
        $(document).ready(function () {
            if (poststatus = 'draft') {
                if (!autosaveOn) {
                    autosaveOn = true;
                    setInterval(function () {
                        var token = '{{{ csrf_token() }}}';
                        var appurl = "{{ url('/posts') }}/";
                        var data = {
                            '_method': method,
                            '_token': token,
                            'id': postid,
                            'post_author': $('select[name=post_author]').val(),
                            'post_title': $('input[name=post_title]').val(),
                            'post_subtitle': $('input[name=post_subtitle]').val(),
                            'post_content': $(".wysiwygeditor").froalaEditor('html.get')
                        };
                        $.ajax({
                            type: "POST",
                            url: "{{ url('post/autosave') }}",
                            data: data,
                            dataType: 'json',
                            success: function (data) {
                                //show autosave notification
                                document.getElementById('autosavenotify').innerHTML =
                                    'Disimpan otomatis pada ' + data['lastsaved'];
                            },
                            error: function (exception) {
                                console.log(data)
                            }
                        });
                    }, 10000);
                }
            }
        })
    }
</script>
<script src="{{URL::asset('js/typeahead.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    function saveRelatedSucces(data)
        {
            if( data == 'true' )
            {
                $('.related-status').removeClass('related-hide');
                $('.related-status').addClass('related-show');
                setTimeout(function(){
                    $('.related-status').removeClass('related-show');
                    $('.related-status').addClass('related-hide');
                }, 3000)
            }
            else
            {
                $('.related-status').addClass('related-hide');
                $('.related-status').removeClass('related-show');
            }
        }
    $(document).ready(function () {
        userautocompletesrc = "{{ route('userautocomplete') }}";
        $("#post_author_search").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: userautocompletesrc,
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('input[name=post_author]').val(ui.item.id);
            },
            minLength: 3,
        });
        postautocompletesrc = "{{ route('postsautocomplete') }}";
        $("#ArtikelTerkait1").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: postautocompletesrc,
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('input[name=ArtikelTerkait1id]').val(ui.item.id);
            },
            minLength: 3,
        });
        $("#ArtikelTerkait2").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: postautocompletesrc,
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('input[name=ArtikelTerkait2id]').val(ui.item.id);
            },
            minLength: 3,
        });
        $("#ArtikelTerkait3").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: postautocompletesrc,
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('input[name=ArtikelTerkait3id]').val(ui.item.id);
            },
            minLength: 3,
        });
        $('.slide-artikel-terkait').slideUp('fast');
        $('.artikel-slide-btn').click(function () {
            $('.slide-artikel-terkait').slideToggle('fast');
        });
        $('#saveRelatedArtikel').click(function () {
            saveTerkait();
        });
        //banner inside article
        $('.slide-banner-inside-article').slideUp('fast');
        $('.banner-inside-article-slide-btn').click(function () {
            $('.slide-banner-inside-article').slideToggle('fast');
        });
        //disable multiple user editing
        var updated_by = $('input[name=updated_by]').val();
        var my_username = $('input[name=my_username]').val();
        var last_edit_minute = $('input[name=last_edit_minute]').val();
        if (updated_by !== my_username && last_edit_minute == 0) {
            var inputs = document.getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type === 'submit' || inputs[i].type === 'text') {
                    //inputs[i].disabled = true;
                }
            }
        }
    });
    //save related article and banner inside article to database
    function saveTerkait()
    {
        if($('#ArtikelTerkait1').val().length === 0)
        {
            $('#ArtikelTerkait1id').val(0);
        }
        if($('#ArtikelTerkait2').val().length === 0)
        {
            $('#ArtikelTerkait2id').val(0);
        }
        if($('#ArtikelTerkait3').val().length === 0)
        {
            $('#ArtikelTerkait3id').val(0);
        }
        $.ajax({
                url: '{{ route('setArtikelTerkait') }}',
                type: 'GET',
                data: {
                    id: $('#idPost').val(),
                    paragraphTerkait1: $('#paragraphTerkait1').val(),
                    ArtikelTerkait1: $('#ArtikelTerkait1id').val(),
                    paragraphTerkait2: $('#paragraphTerkait2').val(),
                    ArtikelTerkait2: $('#ArtikelTerkait2id').val(),
                    paragraphTerkait3: $('#paragraphTerkait3').val(),
                    ArtikelTerkait3: $('#ArtikelTerkait3id').val()
                },
                success: function (data) {
                    saveRelatedSucces(data);
                }
            });
    }
    function updateCountParagraph()
    {
        $("#paragaph-count").html($(".fr-element p").length-1);
    }
    updateCountParagraph();
    setInterval(updateCountParagraph, 500);
</script>
@endsection
