@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-1">
    </div>
        <div class="col-md-8" style="text-align: left;">
            <div class="panel panel-default">
            
            {!! Form::hidden('user_id', Auth::user()->id) !!}
                <div class="panel-heading">Form Pendaftaran</div>
                
                <div class="panel-body">
                <br>
                 @if(Session::has('flash_message'))
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  {{Session::get('flash_message')}}
</div>
@endif
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                   {!! Form::model($workshop, [
                    'method' => 'PATCH',
                    'url' => ['/workshop', $workshop->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}

                    {{ Form::hidden('workshop_id', $workshop->workshop_id) }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Nama Lengkap', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                     <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label','required' => 'required']) !!}
                        <div class="col-md-6">
                            {!! Form::text('email', null , ['class' => 'form-control','required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('workshop_content') ? 'has-error' : ''}}">
                        {!! Form::label('phone_number', 'Nomor Telepon', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('phone_number', null, ['class' => 'form-control','required' => 'required']) !!}
                            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                         {!! Form::label('address', 'Alamat', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('address', null, ['class' => 'form-control','required' => 'required']) !!}
                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    
                    <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : ''}}">
                         {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('tempat_lahir', null, ['class' => 'form-control','required' => 'required']) !!}
                            {!! $errors->first('tempat_lahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    
                     <div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' : ''}}">
                         {!! Form::label('tgl_lahir', 'Tanggal Lahir', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::date('tgl_lahir', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('tgl_lahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>


                     <div class="form-group {{ $errors->has('files') ? 'has-error' : ''}}">
                         {!! Form::label('files', 'Kirim Tulisan dan CV (.doc, .docx, atau .pdf)', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                           {!! Form::file('files[]', ['multiple'=>true], ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}


                    
                </div>
                 
            </div>
           
        </div>
    </div>
</div>
@endsection