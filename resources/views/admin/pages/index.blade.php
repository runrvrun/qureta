@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Pages</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/pages/create') }}" class="btn btn-primary btn-xs" title="Add New Page"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Post Title </th><th> Post Author </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->post_title }}</td><td>{{ $item->post_authors->name }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/page/'.$item->post_slug) }}" class="btn btn-success btn-xs" title="View Page"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/pages/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/pages', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Page" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Page',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($pages,'render') && $pages->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $pages->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
