@extends('layouts.admin')

@section('content')
@if (Session::has('flash_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
<div>
    <ul class="nav nav-tabs" id="myTab">
        <li id="semuatab" class="active"><a href="#semua" data-toggle="tab">Semua ({{ $totaluser }})</a></li>
        <li id="penulistab"><a href="#penulis" data-toggle="tab">Penulis ({{ $penulis->total() }})</a></li>
        <li id="partnertab"><a href="#partner" data-toggle="tab">Partner ({{ $partner->total() }})</a></li>
        <li id="premiumtab"><a href="#premium" data-toggle="tab">Premium ({{ $premium->total() }})</a></li>
        <li id="admintab"><a href="#admint" data-toggle="tab">Admin & Editor ({{ $admin->total() }})</a></li>
    </ul>

    <div class="tab-content" id="tab-content">
        <div class="tab-pane active" id="semua">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id='allusertable'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th data-sortable="false"> Email </th><th data-sortable="false"> Phone </th><th data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username) }}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                        <table class="table table-borderless" id='userTablePartner'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Jumlah Naskah </th><th> Email </th><th> Phone </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partner as $item)
                                @if(Auth::user()->role === 'admin')
                                <tr>
                                     <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username) }}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username) }}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->post_count }}</td><td>{{ $item->email }}</td><td>{{ $item->phone_number }}</td>
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

        <div class="tab-pane" id="admint">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless" id='userTableAdmin'>
                            <thead>
                                <tr>
                                    <th> Username </th><th> Name </th><th> Role </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin as $item)
                                 @if(Auth::user()->role === 'admin')
                                <tr>
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username)}}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->role }}</td>
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
                                    <td>{{ HTML::link('/profile/'.$item->username ,$item->username) }}</td><td>{{ HTML::link('/profile/'.$item->username ,$item->name) }}</td><td>{{ $item->role }}</td>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#allusertable').DataTable({
        processing: true,
        serverSide: true,
        order: [[0,'asc']],
        ajax: '{!! url('/admin/users/data') !!}',
        columns: [
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'}
        ],
        fnRowCallback: function( nRow, aData, iDisplayIndex ) {
              $('td:eq(0)', nRow).html( '<a href="/profile/' + aData.username + '" target="_blank">' + aData.username + '</a>' );
              $('td:eq(1)', nRow).html( '<a href="/profile/' + aData.username + '" target="_blank">' + aData.name + '</a>' );
          },
    });
    $('#userTablePremium').DataTable({
           "order": [[ 0, "asc" ]],
           "paging":   false
    });
    $('#userTablePenulis').DataTable({
           "order": [[ 0, "asc" ]],
           "paging":   false
    });
    $('#userTableAdmin').DataTable({
           "order": [[ 0, "asc" ]],
           "paging":   false
    });
    $('#userTablePartner').DataTable({
           "order": [[ 0, "asc" ]],
           "paging":   false
    });
  });
</script>
@endsection
