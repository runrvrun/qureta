@extends('layouts.admin')

@section('content')
@if (Session::has('flash_message'))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif

{!! Form::open(['url' => '/admin/users/search', 'method'=>'get', 'class' => 'form-horizontal']) !!}
<div class="row">
    <div class="form-group form-inline">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder'=>'Search for user']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}        
            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<div>             
    <ul class="nav nav-tabs" id="myTab">
        <li id="semuatab" class="active"><a href="#semua" data-toggle="tab">Semua ({{ $users->total() }})</a></li>
        <li id="penulistab"><a href="#penulis" data-toggle="tab">Penulis ({{ $penulis->total() }})</a></li>        
        <li id="penulistab"><a href="#admin" data-toggle="tab">Admin & Editor ({{ $admin->total() }})</a></li>
    </ul>

    <div class="tab-content" id="tab-content">
        <div class="tab-pane active" id="semua">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTable'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Email </th><th> Phone </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item) 
                                 @if(Auth::user()->role === 'admin')                               
                                <tr>                                    
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->meta_value }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/users', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete user',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @else
                                <tr>                                    
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->meta_value }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>                        
                        @if(isset($querystring['search']))
                        <div class="pagination-wrapper"> {!! $users->appends(['search' => $querystring['search']])->render() !!} </div>
                        @else
                        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="penulis">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTable'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Jumlah Naskah </th><th> Email </th><th> Phone </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penulis as $item)                                
                                <tr>                                    
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/users', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete user',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                        @if(isset($querystring['search']))
                        <div class="pagination-wrapper"> {!! $penulis->appends(['search' => $querystring['search']])->render() !!} </div>
                        @else
                        <div class="pagination-wrapper"> {!! $penulis->render() !!} </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
<div class="tab-pane" id="admin">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTable'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Role </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin as $item)                                
                                <tr>                                    
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->role }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/users', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete user',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                        @if(isset($querystring['search']))
                        <div class="pagination-wrapper"> {!! $admin->appends(['search' => $querystring['search']])->render() !!} </div>
                        @else
                        <div class="pagination-wrapper"> {!! $admin->render() !!} </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('addjs')
<script>
    $(document).ready(function () {        
        var url = window.location.href;
        if (url.indexOf('penulispage') !== -1) {
            $('#myTab').children().removeClass('active');
            $('#tab-content').children().removeClass('active');
            $('#penulistab').addClass('active');
            $('#penulis').addClass('active');
        }
    });
</script>
@endsection