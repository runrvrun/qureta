@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
          @if (Session::has('flash_message'))
          <div class="alert alert-success alert-dismissible col-md-8" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <p>{!! Session::get('flash_message') !!}</p>
          </div>
          @endif
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Naskah Masuk</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Penulis </th><th> Judul </th><th> Dikirim </th><th>Sedang Diedit</th><th> Kata </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                    <tr>
                                        <td>{{ HTML::link('/profile/'.$item->post_authors->username,$item->post_authors->name) }}</td>
                                        <td>{{ HTML::link('/post/' . $item->post_slug,$item->post_title) }}</td>
                                        <td>{{ $item->submitted_at->format('d M Y H:i') }}</td>
                                        <td>
                                        <?php
                                        $last_edit_minute = Carbon::parse($item->updated_at)->diffInMinutes(Carbon::now());
                                        ?>
                                        @if($last_edit_minute == 0)
                                            {{ $item->updated_by }}
                                        @endif
                                        </td>
                                        <td>{{ str_word_count(strip_tags($item->post_content)) }}</td>
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
