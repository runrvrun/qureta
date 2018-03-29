@extends('layouts.app')

@section('title')
- Pesan Baru
@endsection

@section('content')
<h2 class="page-title">Pesan Baru</h2>
{!! Form::open(['route' => 'messages.store', 'id' => 'message-form']) !!}
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('recipient', 'To', ['class' => 'control-label']) !!}
        {!! Form::text('recipient', $username, ['class' => 'form-control', 'id' => 'recipient']) !!}
    </div>

    <!-- Subject Form Input -->
    <div class="form-group">
        {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Message Form Input -->
    <div class="form-group">
        {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Submit Form Input -->
    <div class="form-group">
        {!! Form::submit('Kirim', ['id' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('addjs')
<script src="{{URL::asset('js/typeahead.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
//prevent keteken enter dan langsung kirim message kosong
$(document).ready(function() {
  $('#recipient').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

//autocomplete username
src = "{{ route('userautocomplete') }}";
 $("#recipient").autocomplete({
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
    },
    minLength: 3,
 });
</script>
@endsection
