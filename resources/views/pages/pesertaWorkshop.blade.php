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
            <div class="panel panel-default">
                <div class="panel-heading">Pendaftar Workshop</div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table-responsive">
                        <table id="table-peserta" class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Nama</th><th>Alamat</th><th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshop as $item)
                                <tr>
                                   
                                    <td>{{ $item->name }}</td>
                                   
                                   <td>{{ $item->address }}</td>
                               
                                    <td>{{ $item->email }}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>

                </div>
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