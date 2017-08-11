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
        {!! Form::text('recipient', $username, ['class' => 'form-control', 'id' => 'recipient', 'data-role' => 'tagsinput']) !!}
        <br>
        <input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">
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
<script>
$(document).ready(function() {
  $('#recipient').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  $('.bootstrap-tagsinput').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>

<script>
$(document).ready(function() {
    var Username = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: '/messages/create',
      remote: {
          url: '/find/%QUERY',
          wildcard: '%QUERY'
      }
  });

    $('#remote .typeahead').typeahead(null, {
     name: 'username',
    display: 'value',
    source: Username
});
  });
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{URL::asset('js/typeahead.bundle.js')}}"></script>
@endsection