@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Banners</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/banners/create') }}" class="btn btn-primary btn-xs" title="Add New Banner"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Position </th><th> Name </th><th> Image </th><th> Link </th><th> Show Until </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->position }}</td><td>{{ $item->name }}</td><td><img src="{{ URL::asset('uploads/banner/'.$item->image) }}" width="150px" /><br/>{{ $item->image }}</td><td>{{ $item->link }}</td><td>{{ $item->show_end->format("d M Y") }}</td>
                                        <td>
                                            <a href="{{ url('/admin/banners/' . $item->id) }}" class="btn btn-success btn-xs" title="View Banner"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/banners/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Banner"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/banners', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Banner" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Banner',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($banners,'render') && $banners->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $banners->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
