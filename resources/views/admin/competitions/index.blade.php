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
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Competitions</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/competitions/create') }}" class="btn btn-primary btn-xs" title="Add New Competition"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Competition Title </th><th>Status</th><th>Naskah</th><th> Competition Startdate </th><th> Competition Enddate </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($competitions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ HTML::link('/admin/competition_posts/'.$item->id,$item->competition_title) }}</td><td>
                                            @if ($item->competition_startdate > Carbon::today()->toDateString())
                                            Akan Datang
                                            @elseif ($item->competition_enddate < Carbon::today()->toDateString())
                                            Ditutup
                                            @else
                                            Sedang Berlangsung
                                            @endif
                                        </td>
                                        <td>{{ HTML::link('/admin/competition_posts/'.$item->id,get_competition_post_count($item->id)) }}</td>
                                        <td>{{ $item->competition_startdate }}</td><td>{{ $item->competition_enddate }}</td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ url('/admin/competitions/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Competition"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/competitions', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Competition" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Competition',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $competitions->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection