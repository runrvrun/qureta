@extends('layouts.app')

@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{{ Session::get('flash_message') }}</p>
</div>
@endif
<?php Carbon::setLocale('id') ?>
<h2 class="page-title">{{ $pagetitle }}</h2>
<br>
<div class="row">
            <div id="workshop-mobile">
                @foreach ($workshops as $key=>$row)     
                    @if(Auth::check())
                        @if(get_peserta_workshop($row->id))                   
                            <div class="article grid-group-item">                
                                <div class="article-info lomba">                            
                                    <h3><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></h3>
                                    <p>{{ $row->workshop_content }}</p>
                                    <div class="periode">Periode pendaftaran: {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}</div>
				<br/>				    
				<p class="btn btn-default">Anda sudah terdaftar</p>
                                </div>        
                            </div>         
                            <hr>
                         @else 
                         <div class="article grid-group-item">                
                                <div class="article-info lomba">                            
                                    <h3><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></h3>
                                    <p>{{ $row->workshop_content }}</p>
                                    <div class="periode">Periode pendaftaran: {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}</div>
                                    <br>
                                    <a href="{{ url('kirim-tulisan/workshop/'.$row->id) }}" class="btn btn-primary">Daftar Workshop</a>
                                </div>        
                            </div>         
                            <hr>
                        @endif
                        @elseif(!Auth::check())
                        <div class="article grid-group-item">                
                                <div class="article-info lomba">                            
                                    <h3><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></h3>
                                    <p>{{ $row->workshop_content }}</p>
                                    <div class="periode">Periode pendaftaran: {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}</div>
                                    <br>
                                    <a href="{{ url('kirim-tulisan/workshop/'.$row->id) }}" class="btn btn-primary">Daftar Workshop</a>
                                </div>        
                            </div>         
                            <hr>
                        @endif
                @endforeach    
            </div>


            <div id="table-mobile" class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Tema </th><th>Pendaftaran</th><th>Keterangan</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($workshops as $key=>$row)
                                @if(Auth::check())
                                    @if(get_peserta_workshop($row->id)) 
                                        <tr>
                                           
                                            <td class="col-md-2"><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></td>
                                            <td class="col-md-2">
                                               {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}
                                            </td>
                                            <td class="col-md-6">
                                               {{ $row->workshop_content }}
                                            </td>
                                            <td class="col-md-6">
                                                <a href="{{ url('edit-workshop/'.$row->id.'/'.Auth::user()->id) }}" class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                 <a href="{{ url('workshop/peserta/'.$row->id) }}" class="btn btn-primary">List Pendaftar</a>
                                            </td>
                                        </tr>
                                    @else   
                                    <tr>
                                          <td class="col-md-2"><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></td>
                                            <td class="col-md-2">
                                               {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}
                                            </td>
                                            <td class="col-md-6">
                                               {{ $row->workshop_content }}
                                            </td> 
                                        <td class="col-md-2">
                                                <a href="{{ url('kirim-tulisan/workshop/'.$row->id) }}" class="btn btn-primary">Daftar Workshop</a>
                                            </td>
                                             <td>
                                                 <a href="{{ url('workshop/peserta/'.$row->id) }}" class="btn btn-primary">List Pendaftar</a>
                                        </td>  
                                    </tr>
                                    @endif
                                    @elseif(!Auth::check())
                                    <tr>
                                        <td class="col-md-2"><a href="{{$row->workshop_link }}">{{$row->workshop_title}}</a></td>
                                            <td class="col-md-2">
                                               {{ $row->workshop_startdate->format('j M Y') }} s.d. {{ $row->workshop_enddate->format('j M Y') }}
                                            </td>
                                            <td class="col-md-6">
                                               {{ $row->workshop_content }}
                                            </td> 
                                        <td class="col-md-2">
                                                <a href="{{ url('kirim-tulisan/workshop/'.$row->id) }}" class="btn btn-primary">Daftar Workshop</a>
                                        </td> 
                                        <td>
                                                 <a href="{{ url('workshop/peserta/'.$row->id) }}" class="btn btn-primary">List Pendaftar</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                         
                        </div>

                    </div>
                </div>
            </div>
        </div>
        

@endsection
