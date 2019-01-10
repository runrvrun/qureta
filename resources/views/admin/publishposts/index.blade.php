@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Naskah Terbit</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Penulis </th><th> Judul </th><th> Tanggal Terbit </th><th> Diterbitkan Oleh </th><th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                  @if(Auth::user()->role === 'admin')
                                    <tr>
                                        <td>{{ $item->post_authors->name }}</td>
                                        <td>{{ HTML::link('/post/' . $item->post_slug,$item->post_title) }}</td>
                                        <td>{{ $item->published_at->format('d M y H:i') }}</td><td>{{ $item->published_by }}</td>
                                        <td style="white-space:nowrap;">
                                          {!! Form::open([
                                              'method'=>'post_title',
                                              'url' => ['/api/send-notification'],
                                              'style' => 'display:inline'
                                          ]) !!}
                                          {!! Form::hidden('title',$item->post_title) !!}
                                          {!! Form::hidden('body',substr(strip_tags($item->post_content),0,200)) !!}
                                          {!! Form::hidden('url',$item->post_slug) !!}
                                              {!! Form::button('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" title="Push Notification" />', array(
                                                      'type' => 'submit',
                                                      'class' => 'btn btn-warning btn-xs',
                                                      'title' => 'Delete Post',
                                                      'onclick'=>'return confirm("Send push notification? (Do not send too often)")'
                                              )) !!}
                                          {!! Form::close() !!}
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
                                    @else
                                    <tr>
                                        <td>{{ $item->post_authors->name }}</td><td>{{ HTML::link('/post/' . $item->post_slug,$item->post_title) }}</td>
                                        <td>{{ $item->published_at }}</td><td>{{ $item->published_by }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/post/' . $item->post_slug) }}" class="btn btn-success btn-xs" title="View Post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/edit-tulisan/' . $item->post_slug) }}" class="btn btn-primary btn-xs" title="Edit Post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>

                                        </td>
                                    </tr>
                                    @endif
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
