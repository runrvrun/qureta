@extends('layouts.app')

@section('title')

@endsection

@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{{ Session::get('flash_message') }}</p>
</div>
@endif
<?php Carbon::setLocale('id') ?>
<br>        

<div class="row">
             <div id="lomba-mobile">
                @foreach ($competitions as $key=>$row)                      
                            <div class="article grid-group-item">                
                                <div class="article-info lomba">                            
                                    <h3><a href="{{url('/peserta-lomba-esai/'.$row->id) }}">{{$row->competition_title}}</a></h3>
                                    
                                    <div class="periode">Periode Lomba: {{ $row->competition_startdate->format('j M Y') }} s.d. {{ $row->competition_enddate->format('j M Y') }} ({{ $row->competition_enddate->diffForHumans() }})</div>
                                    <br>
                                    <a href="{{url('/peserta-lomba-esai/'.$row->id) }}" class="btn btn-primary">Lihat Peserta</a>
                                    <br>
                                </div>        
                            </div>         
                            <hr>
                @endforeach    
            </div>


            <div id="table-lomba" class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lomba Esai</div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                       <th> Judul Lomba </th><th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($competitions as $item)
                                    <tr>
                                        
                                        <td class="col-md-8">{{ HTML::link('/peserta-lomba-esai/'.$item->id,$item->competition_title) }}</td><td>
                                            @if ($item->competition_enddate >= Carbon::today()->toDateString())
                                            Sedang Berlangsung
                                            @elseif ($item->competition_startdate > Carbon::today()->toDateString())
                                            Akan Datang
                                            @else
                                            Ditutup
                                            @endif
                                        </td>
                                       
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $competitions->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
