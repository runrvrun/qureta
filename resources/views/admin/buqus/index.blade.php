
@extends('admin.layouts.admin')

<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
@if (Session::has('flash_message'))
<div class="alert alert-success alert-dismissible col-md-8" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
        <div class="row">
                <div class="panel panel-default col-md-10">
                    <div class="panel-heading">Buqus</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Buqu Title </th><th>Author</th><th>Article</th><th>View</th><th>Created</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($buqus as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ HTML::link('/buqu/'.$item->buqu_slug,$item->buqu_title) }}</td>
                                        <td>{{ HTML::link('/profile/'.$item->buqu_authors->username,$item->buqu_authors->name) }}</td>
                                        <td>{{ $item->buqu_posts->count() }}</td>
                                        <td>{{ $item->view_count }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td style="white-space:nowrap;">
                                            @if(Auth::user()->role === 'admin')
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/buqus', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            @endif
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
