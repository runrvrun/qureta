@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>
                    <div class="panel-body">

                        <a href="{{ url('/posts/create') }}" class="btn btn-primary btn-xs" title="Add New Post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Post Author </th><th> Post Title </th><th> Post Subtitle </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->post_author }}</td><td>{{ $item->post_title }}</td><td>{{ $item->post_subtitle }}</td>
                                        <td>
                                            <a href="{{ url('/posts/' . $item->id) }}" class="btn btn-success btn-xs" title="View Post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/posts/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/posts', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Post" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Post',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($posts,'render') && $posts->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $posts->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection