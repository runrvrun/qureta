@extends('layouts.admin')

@section('content')
    <div class="container">
@if (Session::has('flash_message'))            
<div class="alert alert-success alert-dismissible col-md-8" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
</div>
@endif
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Workshops</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/workshops/create') }}" class="btn btn-primary btn-xs" title="Add New Competition"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Workshops Title </th><th>Peserta</th><th>Status</th><th> Startdate </th><th> Enddate </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($workshops as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ HTML::link('/admin/workshops/peserta/'.$item->id,$item->workshop_title) }}</td>
                                        <td>{{ HTML::link('/admin/workshops/peserta/'.$item->id,get_workshop_post_count($item->id)) }}</td><td>
                                           @if ($item->workshop_startdate > Carbon::today()->toDateString())
                                            Akan Datang
                                            @elseif ($item->workshop_startdate <= Carbon::today()->toDateString() && $item->workshop_enddate >= Carbon::today()->toDateString())
                                            Sedang Berlangsung
                                            @else
                                            Ditutup
                                            @endif
                                        </td>
                                        <td>{{ $item->workshop_startdate }}</td><td>{{ $item->workshop_enddate }}</td>
                                        <td>
                                            <a href="{{ url('/admin/workshops/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Workshop"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/workshops', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Workshop" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Workshop',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $workshops->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection