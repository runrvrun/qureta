@if($post->paymentdone)
  <a href="{{ url('/admin/post/markpaymentundone/' . $post->id) }}" class="btn btn-success btn-xs" style="background-color: #cacaca; border-color: #cacaca;" onclick="return confirm('Hapus tanda dibayar?')"><i class="fa fa-money"></i> <i class="fa fa-check"></i></a>
@else
  <a href="{{ url('/admin/post/markpaymentdone/' . $post->id) }}" class="btn btn-success btn-xs" onclick="return confirm('Tandai sudah dibayar?')"><i class="fa fa-money"></i></a>
@endif
<a href="{{ url('/messages/create?u=' . $post->username) }}" class="btn btn-primary btn-xs" title="Kirim Pesan"><span class="fa fa-envelope-o" aria-hidden="true"/></a>

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
