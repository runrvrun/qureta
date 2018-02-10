@extends('layouts.app')

@section('content')
<h1>{!! $page->post_title !!}</h1>
<div class="article-single content">
{!! $page->post_content !!}
</div>
@endsection
