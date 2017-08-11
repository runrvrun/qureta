@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Category</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/categories', 'class' => 'form-horizontal', 'files' => true]) !!}

                                    <div class="form-group {{ $errors->has('category_title') ? 'has-error' : ''}}">
                {!! Form::label('category_title', 'Category Title', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('category_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('category_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('category_slug') ? 'has-error' : ''}}">
                {!! Form::label('category_slug', 'Category Slug', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('category_slug', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('category_slug', '<p class="help-block">:message</p>') !!}
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