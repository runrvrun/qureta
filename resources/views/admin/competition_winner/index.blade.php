@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Competition_winner</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/competition_winner/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_winner"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Competition Id </th><th> Rank </th><th> Ranktitle </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($competition_winner as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->competition_id }}</td><td>{{ $item->rank }}</td><td>{{ $item->ranktitle }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/admin/competition_winner/' . $item->id) }}" class="btn btn-success btn-xs" title="View Competition_winner"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/competition_winner/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Competition_winner"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/competition_winner', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Competition_winner" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Competition_winner',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $competition_winner->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection