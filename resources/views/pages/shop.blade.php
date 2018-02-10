@extends('layouts.app')

@section('content')
<div class="row topic-title">
    <div class="col-sm-12">
        <h3><a>KAOS</a></h3>
    </div>
</div>
<div class="row vertical-divider">
    @foreach ($kaos as $key=>$row)
    @if($key<4)
    <div class="article col-sm-3 grid-group-item">
        <!--Image-->
        <div class="article-image">
            <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
        </div>
        <!--Article-->
        <div class="article-info">
            <div class="title">{!! HTML::link($row->link, $row->name)!!}</div>
            <div class="info">Rp {{ number_format($row->price,0,'.',',') }}</div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
<div class="row topic-title">
    <div class="col-sm-12">
        <h3><a>MUG</a></h3>
    </div>
</div>
<div class="row vertical-divider">
    @foreach ($mug as $key=>$row)
    @if($key<4)
    <div class="article col-sm-3 grid-group-item">
        <!--Image-->
        <div class="article-image">
            <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
        </div>
        <!--Article-->
        <div class="article-info">
            <div class="title">{!! HTML::link($row->link, $row->name)!!}</div>
            <div class="info">Rp {{ number_format($row->price,0,'.',',') }}</div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">
<div class="row topic-title">
    <div class="col-sm-12">
        <h3><a>LAINNYA</a></h3>
    </div>
</div>
<div class="row vertical-divider">
    @foreach ($lainnya as $key=>$row)
    @if($key<4)
    <div class="article col-sm-3 grid-group-item">
        <!--Image-->
        <div class="article-image">
            <a href="{{ $row->link }}"><img src="{{ $row->image }}" alt="{{ $row->image }}" onerror="imgError(this);" /></a>
        </div>
        <!--Article-->
        <div class="article-info">
            <div class="title">{!! HTML::link($row->link, $row->name)!!}</div>
            <div class="info">Rp {{ number_format($row->price,0,'.',',') }}</div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<hr class="hr-home" style="margin-top: 20px; margin-bottom: -10px; border: 0;border-top: 1px solid #eee;">

@endsection
