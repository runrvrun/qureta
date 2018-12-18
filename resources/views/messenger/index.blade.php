@extends('layouts.app')

@section('title')
- Pesan
@endsection
@section('addhead')
@endsection
@section('content')
<section id="content">
    <div class="container">
          <h2>Pesan</h2>
          <div style="margin-bottom: 10px;">
              <a class="btn btn-primary" href="{{URL::to('messages/create')}}"><i class="fa fa-comments"></i> Pesan Baru</a>
          </div>
          @if($threads->count() > 0)
          <div>
              <div class="panel panel-default">
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-borderless">
                              <thead>
                                  <tr>
                                      <th> Judul </th><th> Dari </th><th>Pesan Terakhir</th><th>Delete</th>
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
                                                  {!! Form::button('<span class="fa fa-trash" aria-hidden="true" title="Delete Message" />', array(
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
    </div>
</section>
@endsection
