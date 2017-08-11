@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body">

                        <a href="{{ url('/messages/create') }}" class="btn btn-primary btn-xs" title="Add New Message"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Sender Id </th><th> Receiver Id </th><th> Message Title </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->sender_id }}</td><td>{{ $item->receiver_id }}</td><td>{{ $item->message_title }}</td>
                                        <td>
                                            <a href="{{ url('/messages/' . $item->id) }}" class="btn btn-success btn-xs" title="View Message"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/messages/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Message"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/messages', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Message" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Message',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $messages->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection