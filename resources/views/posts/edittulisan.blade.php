@extends('layouts.wysiwyg') @section('title') - Edit Tulisan @endsection @section('addcss')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet"> @endsection @section('content')
<?php Carbon::setLocale('id') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            ///make read only for user if post is published
            if ($post->post_status == 'publish' && Auth::user()->role === 'user') {
                $readonly = 'readonly';
                $readonlymsg = 'Tulisan telah terbit dan tidak dapat diedit lagi. Hubungi editor bila Anda ingin melakukan perubahan.';                
            } else {
                $readonly = '';
                $readonlymsg = false;
            }
            if( $related != null )
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
            ?>
                @if (Session::has('flash_message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{!! Session::get('flash_message') !!}</p>
                </div>
                @endif @if ($readonlymsg)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{!! $readonlymsg !!}</p>
                </div>
                @endif
                <!-- disable edit if someone else is editing -->
                <?php
		if($post->updated_at){
			$updated_at = $post->updated_at;
		}else{
			$updated_at = $post->created_at;
		}
	    ?>
                    <input type="hidden" name="last_edit_minute" value="{{ Carbon::parse($updated_at)->diffInMinutes(Carbon::now()) }}" />
                    <input type="hidden" name="updated_by" value="{{$post->updated_by}}" />
                    <input type="hidden" name="my_username" value="{{Auth::user()->username}}" />
                    <div class="alert alert-warning alert-dismissible" role="alert" id="being_edited" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>Artikel ini dikunci karena sedang diedit
                            <span id="being_edited_by"></span>, cobalah beberapa saat lagi.
                            <input class="btn btn-default" type="button" value="Coba lagi" onClick="window.location.reload()">
                        </p>
                    </div>
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif 
                    {!! Form::model($post, [ 'method' => 'PATCH','onsubmit' => 'saveTerkait()' ,'url' => ['/posts', $post->id], 'class' => 'form-horizontal', 'files'=> true ]) !!}
                    {!! Form::hidden('post_id', $post->id) !!}
                    {!! Form::hidden('post_status', $post->post_status) !!}
                    @if(isset($competition))
                    <div class="form-group">
                        <label>Lomba</label>
                        {!! Form::select('post_competition', get_dd_competition($competition->competition->id), $competition->competition->id, ['class'
                        => 'form-control']) !!}
                    </div>
                    @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <div class="form-group">
                        <label>Lomba</label>
                        {!! Form::select('post_competition', get_dd_competition(), null, ['class' => 'form-control']) !!}
                    </div>
                    @endif @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <div class="form-group {{ $errors->has('post_author') ? 'has-error' : ''}}">
                        <label for="post_author">Penulis</label>
                        {!! Form::text('post_author_search', $post->post_authors->name, array('placeholder' => 'Search User','class' => 'form-control','id'=>'post_author_search'))
                        !!} {!! Form::hidden('post_author', $post->post_author) !!} {!! $errors->first('post_author', '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    @endif

                    <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                        <label for="post_title">Judul</label>
                        {!! Form::text('post_title', null, ['class' => 'form-control', 'placeholder' => 'Judul Tulisan', 'id' => 'post_title', $readonly])
                        !!} {!! $errors->first('post_title', '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('post_subtitle') ? 'has-error' : ''}}">
                        <label for="post_title">Sub-judul</label>
                        {!! Form::text('post_subtitle', null, ['class' => 'form-control', 'placeholder' => 'Sub-judul', $readonly]) !!} {!! $errors->first('post_subtitle',
                        '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                        <label for="post_slug">Link </label>{!! Form::text('post_slug', null, ['class' => 'form-control', 'placeholder' => 'Slug/link',
                        $readonly]) !!} {!! $errors->first('post_slug', '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    @endif @if(!empty($post->post_image))
                    <img src="{{ URL::asset('/uploads/post/'.$post->post_image) }}" /> @endif
                    <div class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">
                        {!! Form::file('post_image', ['class' => 'form-control', $readonly]) !!} {!! $errors->first('post_image', '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('post_image_credit') ? 'has-error' : ''}}">
                        <label for="post_title">Sumber foto/ilustrasi</label>
                        {!! Form::text('post_image_credit', null, ['class' => 'form-control', 'placeholder' => 'Sumber foto/ilustrasi', $readonly])
                        !!} {!! $errors->first('post_image_credit', '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                        {!! Form::textarea('post_content', null, ['class' => 'form-control wysiwygeditor']) !!} {!! $errors->first('post_content',
                        '
                        <p class="help-block">:message</p>') !!}
                    </div>
                    {{-- TODO:buat form unutuk artikel terkait --}} @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')

                    <div class="artikel-terkait-box">
                        <center>
                            <a class="btn btn-default artikel-slide-btn">Artikel Terkait</a>
                        </center>
                        <div class="form-group slide-artikel-terkait">
                                    {{ Form::hidden('id', $post->id,array('id'=>'idPost')) }}
                                <div class="row">
                                    <div class="col-sm-2">Paragraph</div>
                                    <div class="col-sm-8">Artikel Terkait</div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <input class="form-control input-sm" type="number" name="paragraphTerkait1" id="paragraphTerkait1" placeholder="paragraph"
                                            min="1" value="{{ $at1 }}">
                                    </div>
                                    <div class="col-sm-10   ">
                                        <input name="ArtikelTerkait1" value="{{ App\Post::where('id', $id1)->value('post_title') }}" type="text" class="form-control input-sm" id="ArtikelTerkait1" placeholder="Artikel Terkait">
                                        <input value="{{ $id1 }}" id="ArtikelTerkait1id" name="ArtikelTerkait1id" type="hidden">
                                    </div>
                                </div>

                                <div style="margin-top:1vh;"></div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <input class="form-control input-sm" type="number" name="paragraphTerkait2" id="paragraphTerkait2" placeholder="paragraph"
                                            min="1" value="{{ $at2 }}">
                                    </div>
                                    <div class="col-sm-10   ">
                                        <input name="ArtikelTerkait2" value="{{ App\Post::where('id', $id2)->value('post_title') }}" type="text" class="form-control input-sm" id="ArtikelTerkait2" placeholder="Artikel Terkait">
                                        <input value="{{ $id2 }}" id="ArtikelTerkait2id" name="ArtikelTerkait2id" type="hidden">
                                    </div>
                                </div>

                                <div style="margin-top:1vh;"></div>
                                
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input class="form-control input-sm" type="number" name="paragraphTerkait3" id="paragraphTerkait3" placeholder="paragraph"
                                            min="1" value="{{ $at3 }}">
                                    </div>
                                    <div class="col-sm-10   ">
                                        <input name="ArtikelTerkait3" value="{{ App\Post::where('id', $id3)->value('post_title') }}" type="text" class="form-control input-sm" id="ArtikelTerkait3" placeholder="Artikel Terkait">
                                        <input value="{{ $id3 }}" id="ArtikelTerkait3id" name="ArtikelTerkait3id" type="hidden">
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group form-inline">
                        <div class="col-md-3">Topik {!! Form::select('post_category', get_dd_categories(), $category, ['class' => 'form-control',
                            $readonly]) !!}</div>
                        <div class="col-md-3">
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor') Topik Redaksi {!! Form::select('post_fcategory', get_dd_fcategories(),
                            $fcategory, ['class' => 'form-control']) !!} @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::hidden('post_status', null) !!} @if ($post->post_status === 'draft' || $post->post_status === 'pending') {!! Form::submit('Kirim
                            ke Editor', ['name' => 'savepending', 'class' => 'btn btn-info pull-right marginleftright'])
                            !!} @endif @if ($post->post_status !== 'publish' || Auth::user()->role === 'admin' || Auth::user()->role
                            === 'editor' || Auth::user()->role === 'premium' || Auth::user()->role === 'partner') {!! Form::submit('Simpan',
                            ['name' => 'save','class' => 'btn btn-success pull-right marginleftright']) !!} @endif
                        </div>
                    </div>
                    <div class="row pull-right">
                        <small id="autosavenotify" class="pull-right"></small>
                    </div>
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <div class="form-group form-inline">
                        <div class="col-md-2">{!! Form::submit('Hapus Tulisan', ['name' => 'delete', 'class' => 'btn btn-danger marginleftright','onclick'
                            => 'return confirm("Hapus tulisan? Tulisan yang dihapus tidak dapat dikembalikan")']) !!}</div>
                        <div class="col-md-3">Sembunyikan {!! Form::checkbox('hide', null, $post->hide) !!}
                            <a href="#" data-toggle="tooltip" title="Sembunyikan tulisan dari list Terpopuler">
                                <i class="fa fa-question-circle-o"></i>
                            </a>
                            <br/>Require Login {!! Form::checkbox('require_login', null, $post->require_login) !!}
                            <a href="#" data-toggle="tooltip" title="Harus login untuk membaca">
                                <i class="fa fa-question-circle-o"></i>
                            </a>
                            <br/>Sticky {!! Form::checkbox('sticky', null, $post->sticky) !!}
                            <a href="#" data-toggle="tooltip" title="Tampilkan terus di home page">
                                <i class="fa fa-question-circle-o"></i>
                            </a>
                            <br/>Hide Adsense {!! Form::checkbox('hide_adsense', null, $post->hide_adsense) !!}
                            <a href="#" data-toggle="tooltip" title="Jangan tampilkan adsense di tulisan ini">
                                <i class="fa fa-question-circle-o"></i>
                            </a>
                        </div>
                        <div class="col-md-7">
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                            <div id="ModalPesan" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Kembalikan Tulisan</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::textarea('moderation_message', null,['id'=>'moderation-message', 'size'=>'40x5']) !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            {!! Form::submit('Confirm', ['name' => 'savedraft', 'class' => 'btn btn-primary pull-right marginleftright','onclick' =>
                                            'return KembalikanTulisan('.$post->id.')']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($post->post_status == 'pending' || $post->post_status == 'publish')
                            <a href="#ModalPesan" role="button" class="btn btn-warning pull-right marginleftright" data-toggle="modal">Kembalikan ke Penulis</a>

                            @endif @endif
                        </div>
                    </div>
                    @else
                    <div class="form-group form-inline">
                        <div class="col-md-2">{!! Form::submit('Hapus Tulisan', ['name' => 'delete', 'class' => 'btn btn-danger marginleftright','onclick'
                            => 'return confirm("Hapus tulisan? Tulisan yang dihapus tidak dapat dikembalikan")']) !!}</div>
                    </div>
                    @endif @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                    <div class="form-group form-inline">
                        <div class="col-md-12">
                            @if($post->post_status !== 'publish' && (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')) {!! Form::submit('Terbitkan',
                            ['name' => 'savepublish', 'class' => 'btn btn-primary pull-right marginleftright','onclick' =>
                            'return confirm("Terbitkan tulisan ini?")']) !!}
                            <span class="pull-right">Terbitkan pada {!! Form::input('text', 'published_at', ($post->published_at != null) ? $post->published_at->format('d-m-Y
                                H:i') : Carbon::now()->format('d-m-Y H:i'), ['id'=>'publish-at','class' => 'form-control'])
                                !!}
                            </span>
                            <!-- {!! Form::input('datetime-local', 'published_at', Carbon::now()->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!} -->
                            @endif
                        </div>
                    </div>
                    <div class="row pull-right">Status: {{ strtoupper($post->post_status) }} {!! ($post->published_by)? '
                        <br/>Published by '.$post->published_by.' at '.Carbon::parse($post->published_at)->format('d-m-Y H:i'):''!!}
                        {!! ($post->updated_by)? '
                        <br/>Last updated by '.$post->updated_by.' at '.Carbon::parse($post->updated_at)->format('d-m-Y H:i'):''!!}
                    </div>
                    @endif {!! Form::close() !!}
        </div>
    </div>
</div>
<?php
//debug post
		if(Auth::check() && Auth::user()->role='admin'){
			//dd($post);
		}
?>
    @endsection @section('addjs')
    <script type="text/javascript">
        $(function () {
            $('#publish-at').datetimepicker({
                locale: 'id'
            });
        });
    </script>
    <script>
        function KembalikanTulisan($postid) {
            var confirmation;
            confirmation = confirm('Kembalikan tulisan ke penulis?');
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
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
                //$("#being_edited_by").text(' oleh {{{ $post->updated_by }}}');
                //$("#being_edited").css('display','block');        
            }
        });
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
    </script>
    @endsection