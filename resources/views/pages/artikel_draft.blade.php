@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<?php Carbon::setLocale('id') ?>
@if(Auth::Check())
<input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
@endif
@if (isset($_SESSION['flash_message']))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{{ Session::get('flash_message') }}</p>
</div>
@endif

<h2 class="page-title">{!! $pagetitle !!} </h2>
<!--select view-->
<div class="row">
    <div class="col-md-12 select-view">       
        <div class="btn-group" role="group">
            <button  type="button" id="grid" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button>
            <button  type="button" id="list" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button>                
        </div>
    </div>
</div>
<hr class="rowspace">
<div class="row vertical-divider">
    @foreach ($posts as $key=>$row)                       
    <div class="article col-sm-3 grid-group-item">        
        <!--Author-->
        <br>
        <div class="user-info">
            @if(strpos($row->post_authors->user_image,'ttps://') || strpos($row->post_authors->user_image,'ttp://'))
            <div class="image"><img src="{{ $row->post_authors->user_image }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
	    @else
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->post_authors->user_image) }}" alt="{{ $row->post_authors->user_image }}" onerror="avaError(this);" /></div>    
            @endif
            <div class="name">{{ HTML::link('/profile/'.$row->post_authors->username, $row->post_authors->name)}}</div>
            <div class="title">{{ get_user_profesi($row->post_author) }}</div>
            <div class="clearfix"></div>
        </div>
        <!--Image-->
        <div class="article-image">
            <img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_image }}" onerror="imgError(this);" />
        </div>       
        <!--Article-->
        <div class="article-info">                            
            <div class="title">{!! HTML::link('/post/'.$row->post_slug, $row->post_title)!!}</div>
            <div>{!! HTML::link('/edit-tulisan/'.$row->post_slug, 'Edit Tulisan',['class'=>'btn btn-primary'])!!}</div>	
        </div>                         
    </div>  
        
    @if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row vertical-divider">
    @endif
    @endforeach    
</div>
@if (method_exists($posts,'render') && $posts->lastPage()>1)
@if(isset($querystring['sp']) && isset($querystring['q']))
<div class="pagination-wrapper"> {!! $posts->appends(['sp' => $querystring['sp'],'q' => $querystring['q']])->render() !!} </div>
@else
<div class="pagination-wrapper"> {!! $posts->render() !!} </div>
@endif
@endif

@endsection
@section('addjs')
<script>
$(document).ready(function (e) {
    /** force crop thumbnails **/
    var articleimage = $('.article-image');
    var width = articleimage.width();
    articleimage.css('height', width * 157 / 262);
    var articleimage = $('.article-image.sidebar');
    var width = articleimage.width();
    articleimage.css('height', width * 157 / 262);
});
</script>
@endsection