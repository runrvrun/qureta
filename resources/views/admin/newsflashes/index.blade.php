@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Newsflashes</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/newsflash/create') }}" class="btn btn-primary btn-xs" title="Add New Newsflash"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Text </th><th> Link </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($newsflashes as $item)
                                    <tr>
                                        <td>{{ $item->text }}</td><td>{{ $item->link }}</td>
                                        <td>
                                            <a href="{{ url('/admin/newsflash/' . $item->id) }}" class="btn btn-success btn-xs" title="View Newsflash"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/newsflash/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Newsflash"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/newsflash', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Newsflash" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Newsflash',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($newsflashes,'render') && $newsflashes->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $newsflashes->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
