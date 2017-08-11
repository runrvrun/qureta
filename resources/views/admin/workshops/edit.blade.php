@extends('layouts.admin')

@section('content')
{{ Carbon::setLocale('id') }}
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Workshop</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($workshop, [
                    'method' => 'PATCH',
                    'url' => ['/admin/workshops', $workshop->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
                   
                    <div class="form-group {{ $errors->has('workshop_title') ? 'has-error' : ''}}">
                        {!! Form::label('workshop_title', 'Tema', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('workshop_title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                     <div class="form-group hidden{{ $errors->has('workshop_author') ? 'has-error' : ''}}">
                        {!! Form::label('workshop_author', 'Workshop Author', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('workshop_author', 'Admin', ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_author', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('workshop_content') ? 'has-error' : ''}}">
                        {!! Form::label('workshop_content', 'Keterangan', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('workshop_content', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_content', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('workshop_startdate') ? 'has-error' : ''}}">
                        {!! Form::label('workshop_startdate', 'Mulai Pendaftaran', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('datetime-local', 'workshop_startdate', Carbon::parse($workshop->workshop_startdate)->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_startdate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('workshop_enddate') ? 'has-error' : ''}}">
                         {!! Form::label('workshop_enddate', 'Akhir Pendaftaran', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('datetime-local', 'workshop_enddate', Carbon::parse($workshop->workshop_enddate)->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_enddate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                     <div class="form-group {{ $errors->has('workshop_link') ? 'has-error' : ''}}">
                        {!! Form::label('workshop_link', 'URL Workshop', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('workshop_link', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('workshop_link', '<p class="help-block">:message</p>') !!}
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