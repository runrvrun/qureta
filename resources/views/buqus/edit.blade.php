@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Buqus {{ $buqus->id }}</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($buqus, [
                    'method' => 'PATCH',
                    'url' => ['/buqus', $buqus->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
		   <div class="form-group {{ $errors->has('buqu_title') ? 'has-error' : ''}}">
                 	<div class="col-md-6 col-md-offset-4">
			@if(isset($buqus->buqu_image))
			     <img src="{{ asset('uploads/buqu/'.$buqus->buqu_image) }}" alt="{{ $buqus->buqu_image }}" />
			@endif
			</div>
                    </div>
                    <div class="form-group {{ $errors->has('buqu_title') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_title', 'Buqu Title', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('buqu_title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))
                    <div class="form-group {{ $errors->has('buqu_slug') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_slug', 'Buqu Slug', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('buqu_slug', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_slug', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{ $errors->has('buqu_image') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_image', 'Buqu Image', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::file('buqu_image', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_image', '<p class="help-block">:message</p>') !!}
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
