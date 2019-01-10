@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
<div class="container">
    <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
    @if (Session::has('flash_message'))
    <div class="alert alert-success alert-dismissible col-md-8" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Naskah Lomba: {{ $competition_posts[0]->comps->competition_title ?? '' }}</div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table-responsive">
                        <table id="table-peserta" class="table table-borderless">
                            <thead>
                                <tr>
                                    <th data-order="desc">Favorit</th><th> Judul </th><th> Penulis </th><th> Tulisan </th><th>View</th><th>Kata</th><th data-field="tanggal" data-sortable="true">Tanggal</th><th data-field="tanggal" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
@if(count($competition_posts) == 0)
<tr><td>Tidak ada hasil</td></tr>
@endif
                            @foreach($competition_posts as $item)
                            @if(Auth::user()->role === 'admin')
                                @if($item->composts)
                                <tr>
                                 <td data-order="desc">
                                        @if(Auth::check())
                                        @if (isLikingCompost($item->id))
                                        <a class="btnLike active" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
                                        @else
                                        <a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
                                        @endif
                                        @else
                                        <a><i class="fa fa-star fav myfav fa-2x"></i></a>
                                        @endif
                                        @if(Auth::user()->role == 'admin')
                                        <?php $otherfav = getOherLikeCompost($item->id); ?>
                                        @if(count($otherfav)>0)
                                        @foreach($otherfav as $of)
                                        <a title="{{ $of->users->name }}"><i class="fa fa-star fav otherfav active fa-2x"></i></a>
                                        @endforeach
                                        @endif
                                        @endif
                                    </td>
                                    <td>{!! HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) !!}</td>
                                    <td>{{ $item->composts->post_authors['name'] }}</td><td>{{ get_user_post_count($item->composts->post_authors['id']) }}</td><td>{{ $item->composts->view_count }}</td><td>{{ str_word_count(strip_tags($item->composts->post_content)) }}</td>

                                    <td>
                                        {{Carbon\Carbon::parse($item->composts->created_at)->format('d-m-Y')}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-success btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                <td>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                @endif
                            @elseif(Auth::user()->role === 'partner' || Auth::user()->role === 'editor')
                                @if($item->composts)
                                <tr>

                                  <td data-order="{{$item->like_count}}">
                                        @if(Auth::check())
                                        @if (isLikingCompost($item->id))
                                        <a class="btnLike active" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
                                        @else
                                        <a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
                                        @endif
                                        @else
                                        <a><i class="fa fa-star fav myfav fa-2x"></i></a>
                                        @endif
                                        @if(Auth::user()->role == 'partner' || Auth::user()->role == 'editor')
                                        <?php $otherfav = getUserLikeCompost($item->id); ?>

                                        @if(count($otherfav)>0)
                                        @foreach($otherfav as $of)
                                        <a title="{{ $of->users->name }}"><i class="fa fa-star fav otherfav active fa-2x"></i></a>
                                        @endforeach
                                        @endif
                                        @endif
                                    </td>
                                    <td>{!! HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) !!}</td>
                                    <td>{{ $item->composts->post_authors['name'] }}</td><td>{{ get_user_post_count($item->composts->post_authors['id']) }}</td><td>{{ $item->composts->view_count }}</td><td>{{ str_word_count(strip_tags($item->composts->post_content)) }}</td>

                                    <td>
                                        {{Carbon\Carbon::parse($item->composts->created_at)->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-success btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                <td>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                @endif
                                @endif
                                 @endforeach
                            </tbody>
                        </table>

                        <table id="table-peserta" class="table table-borderless">
                            <thead>
                                <tr>
                                    <th data-order="desc">Favorit</th><th> Judul </th><th> Penulis </th><th>View</th><th>Kata</th><th data-field="tanggal" data-sortable="true">Tanggal</th><th data-field="actions" data-sortable="false"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                 <br>
                                  @foreach($competition_likes as $item)
                           @if(Auth::user()->role === 'partner' || Auth::user()->role === 'editor')

                                <tr>

                                  <td data-order="{{$item->like_count}}">
                                        @if(Auth::check())
                                        @if (isLikingCompost($item->id))
                                        <a class="btnLike active" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
                                        @else
                                        <a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
                                        @endif
                                        @else
                                        <a><i class="fa fa-star fav myfav fa-2x"></i></a>
                                        @endif
                                        @if(Auth::user()->role == 'partner' || Auth::user()->role == 'editor')
                                        <?php $otherfav = getUserLikeCompost($item->id); ?>

                                        @if(count($otherfav)>0)
                                        @foreach($otherfav as $of)
                                        <a title="{{ $of->users->name }}"><i class="fa fa-star fav otherfav active fa-2x"></i></a>
                                        @endforeach
                                        @endif
                                        @endif
                                    </td>
                                    <td>{!! HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) !!}</td>
                                    <td>{{ $item->composts->post_authors['name'] }}</td><td>{{ $item->composts->view_count }}</td><td>{{ str_word_count(strip_tags($item->composts->post_content)) }}</td>

                                    <td>
                                        {{Carbon\Carbon::parse($item->composts->created_at)->format('d-M-Y')}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-success btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                <td>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                @endif

                                 @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script type="text/javascript">
    $(document).ready(function() {
	    $('#table-peserta').DataTable( {
	    });
	    $("#table-peserta").on("click", ".btnLike", function(){
		   var $this = $(this);
	        $this.toggleClass('active');
	        $this.children("i").toggleClass('active');
	        var postid = $this.data('postid');
	        var followerid = document.getElementById('followerid').value;
	        var token = '{{{ csrf_token() }}}';
	        var data = {"_token": token, "postid": postid, "followerid": followerid};
	        if ($this.hasClass('active')) {
	            $.ajax({
	                url: "/admin/competition_posts/like",
	                type: "POST",
	                data: data,
	                error: function (exception) {
	                    console.log(data);
	                },
	                success: function () {
	                }
	            });
	        } else {
	            $.ajax({
	                url: "/admin/competition_posts/unlike",
	                type: "POST",
	                data: data,
	                error: function (exception) {
	                    console.log(data);
	                },
	                success: function () {
	                }
	            });
	        }
		});
	} );
</script>
@endsection
