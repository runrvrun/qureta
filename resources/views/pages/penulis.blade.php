@extends('layouts.app')

@section('content')
    <div class="row adsense-homepage-top">
        <script  data-cfasync="false" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Qresponsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9742758471829304"
             data-ad-slot="4756147752"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
<h2 class="page-title">{!! $pagetitle !!}</h2>
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
    @if($users->count() == 0)
	<br/><br/><p>Tidak ada hasil</p>
    @endif
<div class="row">
    @foreach ($users as $key=>$row)   
    <div class="article col-sm-3 grid-group-item">            
        <!--Author-->
        <div class="user-info">
	    @if(strpos($row->user_image,'ttps://') || strpos($row->user_image,'ttp://'))
            <div class="image"><img src="{{ $row->user_image }}" alt="{{ $row->user_image }}" onerror="avaError(this);" /></div>    
	    @else
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$row->user_image) }}" alt="{{ $row->user_image }}" onerror="avaError(this);" /></div>    
            @endif
            <div class="name">{{ HTML::link('/profile/'.$row->username, $row->name)}}
@if(isset($row->role) && ($row->role == 'premium' || $row->role == 'partner' || $row->role == 'admin' || $row->role == 'editor'))
<span class="verified-user"></span>
@endif
</div>
            <div class="title">{{ get_user_profesi($row->id) }}</div>
        </div>            
    </div>    
    @if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row">
    @endif
    @endforeach    
</div>
@if (method_exists($users,'render') && $users->lastPage()>1)
@if(isset($querystring['sp']) && isset($querystring['q']))
<div class="pagination-wrapper"> {!! $users->appends(['sp' => $querystring['sp'],'q' => $querystring['q']])->render() !!} </div>
@else
<div class="pagination-wrapper"> {!! $users->render() !!} </div>
@endif
@endif
    <div class="row adsense-homepage-top">
        <script  data-cfasync="false" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Qresponsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9742758471829304"
             data-ad-slot="4756147752"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endsection