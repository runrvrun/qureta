@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Shop {{ $newsflash->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/shops/' . $newsflash->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Shop"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/shops', $newsflash->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Shop',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $newsflash->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $newsflash->name }} </td></tr><tr><th> Size </th><td> {{ $newsflash->size }} </td></tr><tr><th> Image </th><td>
                    <a href="{{ $newsflash->link }}" target="_blank"><img src="{{ URL::asset('uploads/newsflash/'.$newsflash->image) }}" width="100%" /></a>
                    <br/><br/> {{ $newsflash->image }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
