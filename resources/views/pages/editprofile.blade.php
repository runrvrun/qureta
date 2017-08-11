@extends('layouts.app')

@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profil {{ $user->username }}</div>
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
                    'url' => ['/profile/update'],
                    'class' => 'form-horizontal',
                    'files' => true,
                    'autocomplete' => 'off'
                    ]) !!}
                    {{ Form::hidden('user_id',$user->id) }}                    
                    <div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
                        {!! Form::label('user_image', 'Foto', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            @if(!empty($user->user_image))
                            <img src="{{ URL::asset('/uploads/avatar/'.$user->user_image) }}" onerror="avaError(this);"/>                  
                            @endif
                            {!! Form::file('user_image', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('user_image', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Nama', ['class' => 'col-md-4 control-label']) !!} <i class="fa fa-asterisk form-required"></i>
                        <div class="col-md-6">
                            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('tempatlahir') ? 'has-error' : ''}}">
                        {!! Form::label('tempatlahir', 'Tempat Lahir', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('tempatlahir_id',null) }}
                            {!! Form::text('tempatlahir', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('tempatlahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('tanggallahir') ? 'has-error' : ''}}">
                        {!! Form::label('tanggallahir', 'Tanggal Lahir', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('tanggallahir_id',null) }}
                            {!! Form::date('tanggallahir', Carbon::parse($profile->tanggallahir)->format('Y-m-d'), ['class' => 'form-control']) !!}
                            {!! $errors->first('tanggallahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('profesi') ? 'has-error' : ''}}">
                        {!! Form::label('profesi', 'Profesi', ['class' => 'col-md-4 control-label']) !!} <i class="fa fa-asterisk form-required"></i>
                        <div class="col-md-6">
                            {{ Form::hidden('profesi_id',null) }}
                            {!! Form::text('profesi', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('profesi', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('short_bio') ? 'has-error' : ''}}">
                        {!! Form::label('short_bio', 'Biodata Singkat', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('short_bio_id',null) }}
                            {!! Form::textarea('short_bio', null, ['class' => 'form-control','rows' => 3]) !!}
                            {!! $errors->first('short_bio', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                        {!! Form::label('phone_number', 'Nomor Telfon', ['class' => 'col-md-4 control-label']) !!} <a href="#" data-toggle="tooltip" title="Hanya bisa dilihat Admin"><i class="fa fa-question-circle-o"></i></a>
                        <div class="col-md-6">
                            {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
                            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('email_id',null) }}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('kota') ? 'has-error' : ''}}">
                        {!! Form::label('kota', 'Kota/Kabupaten', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('kota_id',null) }}
                            {!! Form::text('kota', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('minat') ? 'has-error' : ''}}">
                        {!! Form::label('minat', 'Minat', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('minat_id',null) }}
                            {!! Form::text('minat', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('minat', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('pendidikan') ? 'has-error' : ''}}">
                        {!! Form::label('pendidikan', 'Pendidikan', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('pendidikan_id',null) }}
                            {!! Form::text('pendidikan', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('pendidikan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                        {!! Form::label('website', 'Website', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">                            
                            {{ Form::hidden('website_id',null) }}
                            {!! Form::text('website', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
                        {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('twitter_id',null) }}
                            {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('linkedin') ? 'has-error' : ''}}">
                        {!! Form::label('linkedin', 'LinkedIn', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::hidden('linkedin_id',null) }}
                            {!! Form::text('linkedin', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('linkedin', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Update Profil', ['class' => 'btn btn-primary']) !!}
                        </div>            
                    </div>
                    {!! Form::close() !!}
@if(Auth::user()->role === 'admin')
                        <div class="col-md-offset-8 col-md-4">
{!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/users', $user->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" /> Delete User', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger',
                                        'title' => 'Delete user',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                        </div>
		@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection