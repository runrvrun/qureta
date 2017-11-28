@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<?php Carbon::setLocale('id'); ?>
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

@endsection
@section('addjs')

@endsection