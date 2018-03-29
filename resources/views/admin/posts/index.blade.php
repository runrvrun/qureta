@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Naskah</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Penulis </th><th> Judul </th><th> Status </th><th> View </th><th> Like </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                    <tr>
                                        <td>{{ HTML::link('/profile/'.$item->post_authors->username,$item->post_authors->name) }}</td>
                                        <td>{{ HTML::link('/post/' . $item->post_slug,$item->post_title) }}</td>
                                        <td>{{ $item->post_status }}</td><td>{{ $item->view_count }}</td><td>{{ $item->like_count }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/post/' . $item->post_slug) }}" class="btn btn-success btn-xs" title="View Post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/edit-tulisan/' . $item->post_slug) }}" class="btn btn-primary btn-xs" title="Edit Post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
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
