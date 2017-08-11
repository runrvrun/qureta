@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Banner {{ $banner->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/banners/' . $banner->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Banner"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/banners', $banner->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Banner',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $banner->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $banner->name }} </td></tr><tr><th> Size </th><td> {{ $banner->size }} </td></tr><tr><th> Image </th><td> 
                    <a href="{{ $banner->link }}" target="_blank"><img src="{{ URL::asset('uploads/banner/'.$banner->image) }}" width="100%" /></a>
                    <br/><br/> {{ $banner->image }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection