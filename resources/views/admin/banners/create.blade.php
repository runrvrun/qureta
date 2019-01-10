@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Banner</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/banners', 'class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
                            {!! Form::label('position', 'Lokasi', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('position', array('inside_article' => 'Dalam Artikel'), 0, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nama', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                {!! Form::label('image', 'Gambar', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                {!! Form::label('link', 'Link (opsional)', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('link', null, ['class' => 'form-control','placeholder' => 'http://']) !!}
                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('show_end') ? 'has-error' : ''}}">
                {!! Form::label('show_end', 'Aktif Sampai (opsional)', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::date('show_end', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('show_end', '<p class="help-block">:message</p>') !!}
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
