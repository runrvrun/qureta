@extends('layouts.app')

@section('content')
<?php Carbon::setLocale('id'); ?>
<h2 class="page-title">{!! $pagetitle !!}</h2>
<div class="row">
    <div class="col-md-12 select-view">       
        <div class="btn-group" role="group">
            <button  type="button" id="grid" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button>
            <button  type="button" id="list" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button>                
        </div>
    </div>
</div>
<hr class="rowspace">
<div class="row">
    @foreach ($users as $key=>$row)       
    <div class="article grid-group-item col-md-3">            
        <!--Author-->        
        <div class="user-info"> 
            @if(strpos($row->user_image,'ttps://') || strpos($row->user_image,'ttp://'))
            <div class="image"><img src="{{ $row->user_image }}" alt="{{ $row->user_image }}" onerror="avaError(this);" /></div>    
	    @else
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->user_image) }}" alt="{{ $row->user_image }}" onerror="avaError(this);" /></div>    
            @endif
            <div class="name">{{ HTML::link('/profile/'.$row->username, $row->name)}}</div>
            <div class="title">{{ get_user_profesi($row->post_author) }}</div>            
            <div class="title">Tulisan: {{ HTML::link('/post/'.$row->post_slug, $row->post_title)}}</div>    
            <div class="title">Diterbitkan: {{ Carbon::parse($row->published_at)->diffForHumans() }}</div>
        </div>  
        <hr>
         <div class="clearfix"></div>          
    </div>    
    @endforeach    
</div>
@endsection