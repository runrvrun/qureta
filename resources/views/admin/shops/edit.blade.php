@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Shop {{ $shop->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($shop, [
                            'method' => 'PATCH',
                            'url' => ['/admin/shops', $shop->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                {!! Form::label('image', 'Image', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                {!! Form::label('link', 'Link', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                {!! Form::label('category', 'Category', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('category', ['kaos'=>'Kaos','mug'=>'Mug','lainnya'=>'Lainnya'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
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
