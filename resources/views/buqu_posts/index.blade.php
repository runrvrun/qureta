@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Buqu_posts</div>
                    <div class="panel-body">

                        <a href="{{ url('/buqu_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Buqu_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Buqu Id </th><th> Post Id </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($buqu_posts as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->buqu_id }}</td><td>{{ $item->post_id }}</td>
                                        <td>
                                            <a href="{{ url('/buqu_posts/' . $item->id) }}" class="btn btn-success btn-xs" title="View Buqu_post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/buqu_posts/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Buqu_post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/buqu_posts', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Buqu_post" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Buqu_post',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $buqu_posts->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection