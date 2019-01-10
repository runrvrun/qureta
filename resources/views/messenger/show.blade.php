@extends('layouts.app')

@section('title')
- Pesan
@endsection
@section('addhead')
@endsection
@section('content')
<section id="content">
    <div class="container">
      <h2 class="page-title">{{ $thread->subject }}</h2>

      @foreach($thread->messages as $message)
      <div class="message-block">
            @component('components.user', ['row' => $message->user])
            @endcomponent
            <div class="col-md-10 message-bubble me">
                <small>{{ $message->created_at->format('d F Y H:i') }}</small>
                <p>{!! $message->body !!}</p>
            </div>
      </div>
      @endforeach
      <div class="clearfix"></div>
      {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
      <!-- Message Form Input -->
      <div class="form-group message-reply-block" style="margin-left:50px;">
          <label for="message">Balasan</label><br/>
          {!! Form::textarea('message', null, ['class' => 'form-control','style' => 'height: 80px;']) !!}
          <!-- Submit Form Input -->
          <div class="form-group">
              {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
          </div>
      </div>
      {!! Form::close() !!}
    </div>
</section>
@endsection

@section('addjs')
<script src="{{ URL::asset('linkifyjs/linkify.min.js') }}"></script>
<script src="{{ URL::asset('linkifyjs/linkify-jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#recipient').keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('.bootstrap-tagsinput').keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('.message-bubble').linkify({
            target: "_blank"
        });
    });
</script>
@endsection
