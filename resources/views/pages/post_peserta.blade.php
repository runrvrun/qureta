@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
    @if (Session::has('flash_message'))            
    <div class="alert alert-success alert-dismissible col-md-8" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10">
            
                
               

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table" style="width: 100%;">
                        <table id="table-peserta" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th> Penulis </th><th> Judul </th><th>Tanggal Terbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($competition_posts as $item)
                            @if($item->composts)
                                <tr>
                                <td>{{ $item->composts->post_authors['name'] }}</td>
                                    <td class="judul-post-lomba"><div>{{ HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) }}</div></td>
                                   
                                   @if($item->composts['published_at'] != '')
                                   <td class="tanggal-publish"><div>{{$item->composts['published_at']->format('d-M-Y')}}</div></td>
                                   @else
                                   <td class="tanggal-publish"><div>Belum Terbit</div></td>
                                   @endif
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                      
                    </div>

                
            
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#table-peserta').DataTable();
} );
</script>

@endsection