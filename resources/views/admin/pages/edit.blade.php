@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <h5>Edit Page: {{ $page->post_title }}</h5>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($page, [
                            'method' => 'PATCH',
                            'url' => ['/admin/pages', $page->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                    {!! Form::hidden('post_author', null, ['class' => 'form-control']) !!}

            <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                {!! Form::label('post_content', 'Content', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::textarea('post_content', null, ['class' => 'form-control wysiwygeditor']) !!}
                    {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                {!! Form::label('post_title', 'Title', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('post_title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_status') ? 'has-error' : ''}}">
                {!! Form::label('post_status', 'Status', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select('post_status', ['draft', 'publish'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                {!! Form::label('post_slug', 'Slug', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('post_slug', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_slug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
