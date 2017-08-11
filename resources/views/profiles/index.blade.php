@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profiles</div>
                    <div class="panel-body">

                        <a href="{{ url('/profiles/create') }}" class="btn btn-primary btn-xs" title="Add New Profile"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> User Id </th><th> Profile Intro </th><th> Profile Slug </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($profiles as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user_id }}</td><td>{{ $item->profile_intro }}</td><td>{{ $item->profile_slug }}</td>
                                        <td>
                                            <a href="{{ url('/profiles/' . $item->id) }}" class="btn btn-success btn-xs" title="View Profile"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/profiles/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Profile"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/profiles', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Profile" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Profile',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $profiles->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection