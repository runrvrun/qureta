@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<h2 class="page-title">{{ $pagetitle }}</h2>
<hr class="rowspace">
<div>Coming soon</div>
<hr class="rowspace">
<a href="{{ url('/') }}" class="btn btn-default">Kembali ke depan</a>
@endsection
