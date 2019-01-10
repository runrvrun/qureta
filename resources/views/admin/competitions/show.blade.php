@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Competition: {{ $competition->competition_title }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/competitions/' . $competition->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Competition"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/competitions', $competition->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Competition',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $competition->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $competition->competition_title }} </td></tr>
                                    <tr><th> Pengumuman </th><td> {{ $competition->competition_content }} </td></tr>
                                    <tr><th> Start Date </th><td> {{ $competition->competition_startdate }} </td></tr>
                                    <tr><th> End Date </th><td> {{ $competition->competition_enddate }} </td></tr>                                    
                                    <tr><th> Juara 1 </th><td> @if(isset($winners[0])) {{ HTML::link('/post/'.$winners[0]->composts->post_slug,$winners[0]->composts->post_title) }} karya {{ $winners[0]->composts->post_authors->name }} @endif</td></tr>
                                    <tr><th> Juara 2 </th><td> @if(isset($winners[1])){{ HTML::link('/post/'.$winners[1]->composts->post_slug,$winners[0]->composts->post_title) }} karya {{ $winners[0]->composts->post_authors->name }} @endif</td></tr>
                                    <tr><th> Juara 3 </th><td> @if(isset($winners[2])){{ HTML::link('/post/'.$winners[2]->composts->post_slug,$winners[0]->composts->post_title) }} karya {{ $winners[0]->composts->post_authors->name }} @endif</td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection