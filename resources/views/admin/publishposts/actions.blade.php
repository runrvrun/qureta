{!! Form::open([
    'method'=>'post_title',
    'url' => ['/api/send-notification'],
    'style' => 'display:inline'
]) !!}
{!! Form::hidden('title',$post->post_title) !!}
{!! Form::hidden('body',substr(strip_tags($post->post_content),0,200)) !!}
{!! Form::hidden('url',$post->post_slug) !!}
    {!! Form::button('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" title="Push Notification" />', array(
            'type' => 'submit',
            'class' => 'btn btn-warning btn-xs',
            'title' => 'Delete Post',
            'onclick'=>'return confirm("Send push notification? (Do not send too often)")'
    )) !!}
{!! Form::close() !!}
  <a href="{{ url('/post/' . $post->post_slug) }}" class="btn btn-success btn-xs" title="View Post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
  <a href="{{ url('/edit-tulisan/' . $post->post_slug) }}" class="btn btn-primary btn-xs" title="Edit Post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
  {!! Form::open([
      'method'=>'DELETE',
      'url' => ['/posts', $post->id],
      'style' => 'display:inline'
  ]) !!}
      {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Post" />', array(
              'type' => 'submit',
              'class' => 'btn btn-danger btn-xs',
              'title' => 'Delete Post',
              'onclick'=>'return confirm("Confirm delete?")'
      )) !!}
  {!! Form::close() !!}
