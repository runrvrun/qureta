@extends('layouts.app')

@section('content')
@if (Session::has('error_message'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error_message') }}
</div>
@endif    
<div class="row">
    <a class="btn btn-primary" href="{{URL::to('messages/create')}}">New Message</a>
</div>
<br>
@if($threads->count() > 0)
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th> Judul </th><th> Peserta </th><th>Pesan Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($threads as $thread)                        
                        <?php $class = $thread->isUnread($currentUserId) ? 'unread-message' : 'read-message'; ?>
                        <?php $fontweight = $thread->isUnread($currentUserId) ? 'bold' : 'normal'; ?>
                        <tr class="{{ $class }}">
                            <td style="font-weight: {{ $fontweight }}">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</td>
                            <td>{{ $thread->participantsString(Auth::id()) }}</td>
                            <td>{!! link_to('messages/' . $thread->id, \Illuminate\Support\Str::words(strip_tags($thread->latestMessage->body ? $thread->latestMessage->body : ''), $words = 10, $end = '...')) !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@else
<br><br><br>
<p>No messages</p>
@endif
@endsection