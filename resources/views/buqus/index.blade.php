@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Buqu Saya</div>
                    <div class="panel-body">

                        <a href="{{ url('/buqus/create') }}" class="btn btn-primary btn-xs" title="Add New Buqus"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Buqu Author </th><th> Buqu Title </th><th> Buqu Image </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($buqus as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->buqu_author }}</td><td>{{ $item->buqu_title }}</td><td>{{ $item->buqu_image }}</td>
                                        <td>
                                            <a href="{{ url('/buqus/' . $item->id) }}" class="btn btn-success btn-xs" title="View Buqus"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/buqus/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Buqus"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/buqus', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Buqus" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Buqus',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $buqus->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection