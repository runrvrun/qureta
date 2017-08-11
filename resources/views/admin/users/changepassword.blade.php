@extends('layouts.app')

@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{ Session::get('flash_message') }}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Password</div>

                <div class="panel-body">
                    {!! Form::open(['url' => '/admin/users/changepass', 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}                    
                    {!! Form::hidden('userid',$userid) !!}

                    <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                        <label for="newpassword" class="col-md-4 control-label">Password Baru</label>

                        <div class="col-md-6">
                            <input id="newpassword" type="password" class="form-control" name="newpassword">

                            @if ($errors->has('newpassword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newpassword') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
                        <label for="newpassword_confirmation" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input id="newpassword_confirmation" type="password" class="form-control" name="newpassword_confirmation">

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Ubah Password
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
