@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Buqu_post {{ $buqu_post->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('buqu_posts/' . $buqu_post->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Buqu_post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['buqu_posts', $buqu_post->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Buqu_post',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $buqu_post->id }}</td>
                                    </tr>
                                    <tr><th> Buqu Id </th><td> {{ $buqu_post->buqu_id }} </td></tr><tr><th> Post Id </th><td> {{ $buqu_post->post_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection