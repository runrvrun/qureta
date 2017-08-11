@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Buqus {{ $buqus->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('buqus/' . $buqus->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Buqus"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['buqus', $buqus->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Buqus',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $buqus->id }}</td>
                                    </tr>
                                    <tr><th> Buqu Author </th><td> {{ $buqus->buqu_author }} </td></tr><tr><th> Buqu Title </th><td> {{ $buqus->buqu_title }} </td></tr><tr><th> Buqu Image </th><td> {{ $buqus->buqu_image }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection