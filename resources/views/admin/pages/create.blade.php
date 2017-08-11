@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Page</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/pages', 'class' => 'form-horizontal', 'files' => true]) !!}

                    {!! Form::hidden('post_author', Auth::user()->id) !!}                                    
            <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                {!! Form::label('post_title', 'Post Title', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('post_title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                {!! Form::label('post_content', 'Post Content', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::textarea('post_content', null, ['class' => 'form-control wysiwygeditor']) !!}
                    {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_status') ? 'has-error' : ''}}">
                {!! Form::label('post_status', 'Post Status', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select('post_status', ['publish','draft'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('comment_status') ? 'has-error' : ''}}">
                {!! Form::label('comment_status', 'Comment Status', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select('comment_status', ['open', 'close'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('comment_status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                {!! Form::label('post_slug', 'Post Slug', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('post_slug', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_slug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-4">
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