@extends('layouts.admin')

@section('content')
{{ Carbon::setLocale('id') }}
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Lomba</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/admin/competitions', 'class' => 'form-horizontal', 'files' => true]) !!}
                    {{ Form::hidden('competition_author', Auth::user()->id) }}
                    <div class="form-group {{ $errors->has('competition_title') ? 'has-error' : ''}}">
                        {!! Form::label('competition_title', 'Judul Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('competition_title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_content') ? 'has-error' : ''}}">
                        {!! Form::label('competition_content', 'Pengantar Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('competition_content', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_content', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_startdate') ? 'has-error' : ''}}">
                        {!! Form::label('competition_startdate', 'Mulai Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::date('competition_startdate', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_startdate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_enddate') ? 'has-error' : ''}}">
                        {!! Form::label('competition_enddate', 'Akhir Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::date('competition_enddate', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_enddate', '<p class="help-block">:message</p>') !!}
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