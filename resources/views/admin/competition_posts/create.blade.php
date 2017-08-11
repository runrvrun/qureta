@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Competition_post</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/competition_posts', 'class' => 'form-horizontal', 'files' => true]) !!}

                                    <div class="form-group {{ $errors->has('competition_id') ? 'has-error' : ''}}">
                {!! Form::label('competition_id', 'Competition Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('competition_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('competition_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
                {!! Form::label('post_id', 'Post Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('post_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
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