@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Tambahkan Tulisan Ke Buqu</div>
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

                    {!! Form::open(['url' => '/buqu_posts', 'class' => 'form-horizontal', 'files' => true]) !!}
                    
                    <div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
                        {!! Form::label('post_id', 'Tulisan', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::hidden('post_id', $posts->id) !!} {{ $posts->post_title }}
                            {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('buqu_id') ? 'has-error' : ''}}">
                        {!! Form::label('buqu_id', 'Buqu', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">                            
                            {!! Form::select('buqu_id', $buqus, $newbuquid, ['class' => 'form-control']) !!}
                            {!! $errors->first('buqu_id', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="col-md-2"><a href="{{ url('/buqus/create') }}" class="btn btn-default">Buqu Baru</a></div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Tambahkan', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection