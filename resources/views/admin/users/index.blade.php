@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

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
        <li id="penulistab"><a href="#partner" data-toggle="tab">Partner ({{ $partner->total() }})</a></li>        
        <li id="penulistab"><a href="#premium" data-toggle="tab">Premium ({{ $premium->total() }})</a></li>        
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
                                    <th> Username </th><th> Name </th><th data-sortable="false"> Email </th><th data-sortable="false"> Phone </th><th data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item) 
                                 @if(Auth::user()->role === 'admin')                               
                                <tr>                                    
                                     <td class="td_username">{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td class="td_name">{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/profile/' . $item->username) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
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
                                         <a href="#myModal" class="btn-kirim-pesan btn btn-success btn-xs" title="Kirim Pesan"><span class="glyphicon glyphicon-inbox" aria-hidden="true"/></a>
                                    </td>
                                </tr>
                                @else
                                <tr>                                    
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->meta_value }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                       
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

        <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Kirim Pesan</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['route' => 'messages.store', 'id' => 'message-form']) !!}
                Send to:
                <br>
               <input type="text" readonly="" class="form-control" name="recipient" id="frm_username">
              <br>
               <input type="text" readonly="" class="form-control" name="name" id="frm_name">
               <br>
               Subject:
               <br>
               <input type="text" class="form-control" name="subject" id="subject">
               <br>
                Message:
                <br>
               <textarea id="text" class="form-control" name="message" id="message"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

        <div class="tab-pane" id="penulis">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTablePenulis'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Jumlah Naskah </th><th data-sortable="false"> Email </th><th data-sortable="false"> Phone </th><th data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penulis as $item)      
                                @if(Auth::user()->role === 'admin')                            
                                <tr>                                    
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                      
                                    </td>
                                </tr>
                                @endif
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

         <div class="tab-pane" id="partner">
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
                                @foreach($partner as $item)      
                                @if(Auth::user()->role === 'admin')                            
                                <tr>                                    
                                     <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                      
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>                        
                        @if(isset($querystring['search']))
                        <div class="pagination-wrapper"> {!! $partner->appends(['search' => $querystring['search']])->render() !!} </div>
                        @else
                        <div class="pagination-wrapper"> {!! $partner->render() !!} </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        <div class="tab-pane" id="premium">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTablePremium'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Jumlah Naskah </th><th data-sortable="false"> Email </th><th data-sortable="false"> Phone </th><th data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($premium as $item)      
                                @if(Auth::user()->role === 'admin')                            
                                <tr>                                    
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                      
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>                        
                         @if(isset($querystring['search']))
                        <div class="pagination-wrapper"> {!! $premium->appends(['search' => $querystring['search']])->render() !!} </div>
                        @else
                        <div class="pagination-wrapper"> {!! $premium->render() !!} </div>
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
                                 @if(Auth::user()->role === 'admin')                                   
                                <tr>                                    
                                    < <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ $item->name }}</td><td>{{ $item->role }}</td>
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
                                    <td>{{ $item->username }}</td><td>{{ $item->name }}</td><td>{{ $item->role }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                       
                                     
                                    </td>
                                </tr>
                                @endif
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
<script>
$('.btn-kirim-pesan').click(function(){
    var $row = $(this).closest('tr');
   // var rowID = $row.attr('class').split('_')[1];
    var username =  $row.find('.td_username').text();
    var name =  $row.find('.td_name').text();
    //$('#frm_id').val(rowID);
    $('#frm_username').val(username);
    $('#frm_name').val(name);
   $('#myModal').modal('show');
});
</script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#userTablePremium').DataTable( {
         "order": [[ 0, "asc" ]],
         "paging":   false
       } );
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#userTable').DataTable( {
         "order": [[ 0, "asc" ]],
         "paging":   false
       } );
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#userTablePenulis').DataTable( {
         "order": [[ 0, "asc" ]],
         "paging":   false
       } );
} );
</script>
@endsection