@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Competition_winner {{ $competition_winner->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/competition_winner/' . $competition_winner->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Competition_winner"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/competition_winner', $competition_winner->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Competition_winner',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $competition_winner->id }}</td>
                                    </tr>
                                    <tr><th> Competition Id </th><td> {{ $competition_winner->competition_id }} </td></tr><tr><th> Rank </th><td> {{ $competition_winner->rank }} </td></tr><tr><th> Ranktitle </th><td> {{ $competition_winner->ranktitle }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection