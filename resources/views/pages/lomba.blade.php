@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
{{ Carbon::setLocale('id') }}
<h2 class="page-title">{{ $pagetitle }}</h2>
<div class="row vertical-divider">
    @if(count($lombas)>0)
      @foreach ($lombas as $key=>$row)
      <div class="article grid-group-item">
          <div class="article-info lomba">
              <div class="title">{{ $row->competition_title }}</div>
              <p>{{ $row->competition_content }}</p>
              <div class="periode">Periode lomba: {{ $row->competition_startdate->format('j M Y') }} s.d. {{ $row->competition_enddate->format('j M Y') }} ({{ $row->competition_enddate->diffForHumans() }})</div>
              <br>
              <a href="{{ url('kirim-tulisan/lomba/'.$row->id) }}" class="btn btn-warning">Kirim Tulisan</a>
          </div>
      </div>
      <hr>
      @endforeach
    @else
      <div style="text-align:center">Belum ada lomba. Kami akan mengumumkan di web ini jika ada lomba baru.</div>
    @endif
</div>
@if (method_exists($lombas,'render') && $lombas->lastPage()>1)
<div class="pagination-wrapper"> {!! $lombas->render() !!} </div>
@endif
@endsection
