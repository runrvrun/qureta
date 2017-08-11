@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile {{ $profile->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('profiles/' . $profile->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Profile"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['profiles', $profile->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Profile',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $profile->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $profile->user_id }} </td></tr><tr><th> Profile Intro </th><td> {{ $profile->profile_intro }} </td></tr><tr><th> Profile Slug </th><td> {{ $profile->profile_slug }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection