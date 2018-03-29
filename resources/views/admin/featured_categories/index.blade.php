@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Topik Redaksi</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/featured_categories/create') }}" class="btn btn-primary btn-xs" title="Add New Featured_category"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Category Title </th><th> Category Slug </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($featured_categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ HTML::link('/topik-redaksi/'.$item->category_slug,$item->category_title) }}</td><td>{{ HTML::link('/topik-redaksi/'.$item->category_slug,$item->category_slug) }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/admin/featured_categories/' . $item->id) }}" class="btn btn-success btn-xs" title="View Featured_category"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/featured_categories/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Featured_category"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/featured_categories', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Featured_category" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Featured_category',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if (method_exists($featured_categories,'render') && $featured_categories->lastPage()>1)
                            <div class="pagination-wrapper"> {!! $featured_categories->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
