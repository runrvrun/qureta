@extends('layouts.app')

@section('content')
{{ Carbon::setLocale('id') }}
<div class="col-md-10">
    <h2 class="page-title">{{ $thread->subject }}</h2>
    <p>Penerima: 
        @foreach($users as $row)
        {{$row->name}},
        @endforeach
    </p>

    @foreach($thread->messages as $message)
    <div class="row message-block">
        @if($message->user->username == Auth::user()->username)        
        <div class="user-info col-md-2">
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$message->user->user_image) }}" onerror="avaError(this);" /></div>
        </div>
        <div class="col-md-10 message-bubble me">                    
            <div class="name">{{ HTML::link('/profile/'.$message->user->username, $message->user->name)}}</div>            
            <p>{!! $message->body !!}</p>
            <div class="text-muted pull-right"><small>{{ $message->created_at->format('d M Y H:i') }}</small></div>                    
        </div>
        @else        
        <div class="user-info col-md-2">
            <div class="image"><img src="{{ URL::asset('/uploads/avatar/'.$message->user->user_image) }}" onerror="avaError(this);" /></div>
        </div>
        <div class="col-md-10 message-bubble you">                    
            <div class="name">{{ HTML::link('/profile/'.$message->user->username, $message->user->name)}}</div>
            <p>{!! $message->body !!}</p>
            <div class="text-muted pull-right"><small>{{ $message->created_at->format('d M Y H:i') }}</small></div>                    
        </div>
        @endif
    </div>
    @endforeach
    <div class="clearfix"></div>
    {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
    <!-- Message Form Input -->        
    <div class="form-group">
        <label for="message">Balasan</label>
        {!! Form::textarea('message', null, ['class' => 'form-control','rows'=>5]) !!}
    </div>

    <!-- Submit Form Input -->
    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
</div>
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