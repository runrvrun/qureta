@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit user {{ $user->id }}</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/admin/users', $user->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}

                     <div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
                        {!! Form::label('user_image', 'Foto', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            @if(!empty($user->user_image))
                            <img src="{{ URL::asset('/uploads/avatar/'.$user->user_image) }}"/>
                            @endif
                            {!! Form::file('user_image', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('user_image', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                        {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('username', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                     <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                        {!! Form::label('phone_number', 'No. Telpon', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
                        {!! Form::label('role', 'Role', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('role', ['user'=>'User','editor'=>'Editor','admin'=>'Administrator','partner'=>'Partner','premium'=>'Premium'], null, ['class' => 'form-control']) !!}
                            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                        {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('status', [1=>'active',0=>'inactive'], null, ['class' => 'form-control']) !!}
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('banned') ? 'has-error' : ''}}">                
                        {!! Form::label('banned', 'Banned', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">                    
                            {!! Form::checkbox('banned', null, $user->banned_until > Carbon::now(), ['id' => 'banned']) !!}
			    {!! Form::hidden('banned_until', '2038-01-01') !!}
                        </div>
                    </div>
                    <!--div class="form-group {{ $errors->has('banned_until') ? 'has-error' : ''}}" id='banned-until'>
                        {!! Form::label('banned_until', 'Until', ['class' => 'col-md-1 col-md-offset-4 control-label']) !!}
                        <div class="col-md-5">                    
                            {!! Form::input('datetime-local', 'banned_until', Carbon::parse($user->banned_until)->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!}
                            {!! $errors->first('banned_until', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div-->


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

@section('addjs')
<script>
    $(document).ready(function(){
        if($('#banned').is(":checked")) {
            $('#banned-until').css('display','block');
        }else{
            $('#banned-until').css('display','none')
        }
    });
    $('#banned').change(function () {
        if($(this).is(":checked")) {
            $('#banned-until').css('display','block');
        }else{
            $('#banned-until').css('display','none')
        }
    });
</script>
@endsection