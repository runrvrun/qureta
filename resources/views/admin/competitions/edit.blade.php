@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

@section('content')
<?php Carbon::setLocale('id'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Lomba: {{ $competition->competition_title }}</div>
                <div class="panel-body">

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($competition, [
                    'method' => 'PATCH',
                    'url' => ['/admin/competitions', $competition->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
                    {{ Form::hidden('competition_author', Auth::user()->id) }}

                    <div class="form-group {{ $errors->has('competition_title') ? 'has-error' : ''}}">
                        {!! Form::label('competition_title', 'Judul Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('competition_title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_content') ? 'has-error' : ''}}">
                        {!! Form::label('competition_content', 'Pengantar Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('competition_content', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('competition_content', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_startdate') ? 'has-error' : ''}}">
                        {!! Form::label('competition_startdate', 'Mulai Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('text', 'competition_startdate', Carbon::parse($competition->competition_startdate)->format('d-m-Y\TH.i'), ['id'=>'competition_startdate','class' => 'form-control']) !!}
                            {!! $errors->first('competition_startdate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('competition_enddate') ? 'has-error' : ''}}">
                        {!! Form::label('competition_enddate', 'Akhir Lomba', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                          {!! Form::input('text', 'competition_enddate', Carbon::parse($competition->competition_enddate)->format('d-m-Y\TH.i'), ['id'=>'competition_enddate','class' => 'form-control']) !!}
                          {!! $errors->first('competition_enddate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        {!! Form::label('pemenang', 'Pemenang', ['class' => 'col-md-4 control-label']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('rank[0]', '1', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::hidden('rank[0]', 1) !!}
                            {!! Form::text('ranktitle[0]', isset($ranktitle[0])? $ranktitle[0]:'Pemenang 1', ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('rankpost_search0', (isset($rankpost[0]) && isset($posts[$rankpost[0]]))? $posts[$rankpost[0]]:null, array('placeholder' => 'Pilih pemenang','class' => 'form-control','id'=>'rankpost_search0')) !!}
	                    {!! Form::hidden('rankpost[0]', isset($rankpost[0])? $rankpost[0]:null) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('rank[1]', '2', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::hidden('rank[1]', 2) !!}
                            {!! Form::text('ranktitle[1]', 'Pemenang 2', ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('rankpost_search1', (isset($rankpost[1]) && isset($posts[$rankpost[1]]))? $posts[$rankpost[1]]:null, array('placeholder' => 'Pilih pemenang','class' => 'form-control','id'=>'rankpost_search1')) !!}
	                    {!! Form::hidden('rankpost[1]', isset($rankpost[1])? $rankpost[1]:null) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('rank[2]', '3', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::hidden('rank[2]', 3) !!}
                            {!! Form::text('ranktitle[2]', 'Pemenang 3', ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-5">
                            {!! Form::text('rankpost_search2', (isset($rankpost[2]) && isset($posts[$rankpost[2]]))? $posts[$rankpost[2]]:null, array('placeholder' => 'Pilih pemenang','class' => 'form-control','id'=>'rankpost_search2')) !!}
	                    {!! Form::hidden('rankpost[2]', isset($rankpost[2])? $rankpost[2]:null) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
<script src="{{URL::asset('js/typeahead.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
   $(document).ready(function() {
     $('#competition_startdate').datetimepicker({
     locale: 'id'
     });
     $('#competition_enddate').datetimepicker({
     locale: 'id'
     });

    src = "{{ route('compostautocomplete',$competition->id) }}";
     $("#rankpost_search0").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('input[name="rankpost[0]"]').val(ui.item.id);
        },
        minLength: 3,
     });
     $("#rankpost_search1").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('input[name="rankpost[1]"]').val(ui.item.id);
        },
        minLength: 3,
     });
     $("#rankpost_search2").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('input[name="rankpost[2]"]').val(ui.item.id);
        },
        minLength: 3,
     });

   });
</script>
@endsection
