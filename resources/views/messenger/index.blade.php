@extends('layouts.app')

@section('content')
@if (Session::has('error_message'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error_message') }}
</div>
@endif
@if (Session::has('flash_message'))            
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>{!! Session::get('flash_message') !!}</p>
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
                            <th> Judul </th><th> Peserta </th><th>Pesan Terakhir</th><th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($threads as $thread)                        
                        <?php $class = $thread->isUnread($currentUserId) ? 'unread-message' : 'read-message'; ?>
                        <?php $fontweight = $thread->isUnread($currentUserId) ? 'bold' : 'normal'; ?>
                        <tr class="{{ $class }}">
                            <td style="font-weight: {{ $fontweight }}">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</td>
                            <td>{{ $thread->participantsString(Auth::id()) }}</td>
                            <td>{!! link_to('messages/' . $thread->id, \Illuminate\Support\Str::words(strip_tags($thread->latestMessage->body), $words = 10, $end = '...')) !!}</td>
                            <td> {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/messages', $thread->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Message" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete message',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @if (method_exists($threads,'render') && $threads->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $threads->render() !!} </div>
                        @endif
            </div>

        </div>
    </div>
</div>
@else
<br><br><br>
<p>No messages</p>
@endif
@endsection