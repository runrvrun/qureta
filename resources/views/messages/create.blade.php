@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Message</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/messages', 'class' => 'form-horizontal', 'files' => true]) !!}

                                    <div class="form-group {{ $errors->has('sender_id') ? 'has-error' : ''}}">
                {!! Form::label('sender_id', 'Sender Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('sender_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('sender_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('receiver_id') ? 'has-error' : ''}}">
                {!! Form::label('receiver_id', 'Receiver Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('receiver_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('receiver_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('message_title') ? 'has-error' : ''}}">
                {!! Form::label('message_title', 'Message Title', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('message_title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('message_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('message_content') ? 'has-error' : ''}}">
                {!! Form::label('message_content', 'Message Content', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::textarea('message_content', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('message_content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection