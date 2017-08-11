@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Message {{ $message->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('messages/' . $message->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Message"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['messages', $message->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Message',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $message->id }}</td>
                                    </tr>
                                    <tr><th> Sender Id </th><td> {{ $message->sender_id }} </td></tr><tr><th> Receiver Id </th><td> {{ $message->receiver_id }} </td></tr><tr><th> Message Title </th><td> {{ $message->message_title }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection