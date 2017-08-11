@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
<h2 class="page-title">{!! $pagetitle !!}</h2>
<hr class="rowspace">
<div>Anda belum memiliki tulisan yang {{ $statusname }}</div>
<hr class="rowspace">
<a href="{{ url('/kirim-tulisan') }}" class="btn btn-success">Kirim Tulisan</a>
@endsection
