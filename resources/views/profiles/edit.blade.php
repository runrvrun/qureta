@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profile {{ $profile->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($profile, [
                            'method' => 'PATCH',
                            'url' => ['/profiles', $profile->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('profile_intro') ? 'has-error' : ''}}">
                {!! Form::label('profile_intro', 'Profile Intro', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::textarea('profile_intro', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('profile_intro', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('profile_slug') ? 'has-error' : ''}}">
                {!! Form::label('profile_slug', 'Profile Slug', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('profile_slug', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('profile_slug', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('profesi') ? 'has-error' : ''}}">
                {!! Form::label('profesi', 'Profesi', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('profesi', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('profesi', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('minat') ? 'has-error' : ''}}">
                {!! Form::label('minat', 'Minat', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('minat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('minat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
                {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                {!! Form::label('website', 'Website', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('profile_header_image') ? 'has-error' : ''}}">
                {!! Form::label('profile_header_image', 'Profile Header Image', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::file('profile_header_image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('profile_header_image', '<p class="help-block">:message</p>') !!}
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