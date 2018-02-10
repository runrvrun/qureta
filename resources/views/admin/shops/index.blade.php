@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Shops</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/shops/create') }}" class="btn btn-primary btn-xs" title="Add New Shop"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Name </th><th> Price </th><th> Category </th><th> Link </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($shops as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td><td>{{ $item->price }}</td><td>{{ $item->category }}</td><td>{{ $item->link }}</td>
                                        <td>
                                            <a href="{{ url('/admin/shops/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Shop"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/shops', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Shop" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Shop',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($shops,'render') && $shops->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $shops->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
