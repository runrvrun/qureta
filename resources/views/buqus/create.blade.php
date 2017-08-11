@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Buqu</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    @if(Session::has('flash_message'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ Session::get('flash_message') }}
                    </div>
                    @endif

                    {!! Form::open(['url' => '/buqus', 'class' => 'form-horizontal', 'files' => true]) !!}
                    {!! Form::hidden('buqu_author', Auth::user()->id) !!}  
                    {!! Form::hidden('share_count', 0) !!}
                    {!! Form::hidden('like_count', 0) !!}

                    <div class="form-group {{ $errors->has('buqu_title') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_title', 'Judul Buqu ', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('buqu_title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('buqu_image') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_image', 'Cover Buqu ', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::file('buqu_image', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_image', '<p class="help-block">:message</p>') !!}
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