@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Post {{ $post->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($post, [
                            'method' => 'PATCH',
                            'url' => ['/posts', $post->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                                    <div class="form-group {{ $errors->has('post_author') ? 'has-error' : ''}}">
                {!! Form::label('post_author', 'Post Author', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('post_author', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_author', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                {!! Form::label('post_title', 'Post Title', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::textarea('post_title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_subtitle') ? 'has-error' : ''}}">
                {!! Form::label('post_subtitle', 'Post Subtitle', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::textarea('post_subtitle', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_subtitle', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                {!! Form::label('post_content', 'Post Content', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::textarea('post_content', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_status') ? 'has-error' : ''}}">
                {!! Form::label('post_status', 'Post Status', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('post_status', ['draft', 'publish'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('comment_status') ? 'has-error' : ''}}">
                {!! Form::label('comment_status', 'Comment Status', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('comment_status', ['open', 'close'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('comment_status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                {!! Form::label('post_slug', 'Post Slug', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('post_slug', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_slug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">
                {!! Form::label('post_image', 'Post Image', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::file('post_image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('post_image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('reading_duration') ? 'has-error' : ''}}">
                {!! Form::label('reading_duration', 'Reading Duration', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('reading_duration', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('reading_duration', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('view_count') ? 'has-error' : ''}}">
                {!! Form::label('view_count', 'View Count', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('view_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('view_count', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('comment_count') ? 'has-error' : ''}}">
                {!! Form::label('comment_count', 'Comment Count', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('comment_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('comment_count', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('share_count') ? 'has-error' : ''}}">
                {!! Form::label('share_count', 'Share Count', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('share_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('share_count', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('like_count') ? 'has-error' : ''}}">
                {!! Form::label('like_count', 'Like Count', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('like_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('like_count', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('buqu_count') ? 'has-error' : ''}}">
                {!! Form::label('buqu_count', 'Buqu Count', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('buqu_count', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('buqu_count', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
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