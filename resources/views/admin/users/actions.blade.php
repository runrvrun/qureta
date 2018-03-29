<a href="{{ url('/admin/users/changepassword/' . $item->id) }}" class="btn btn-warning btn-xs" title="Change Password"><span class="glyphicon glyphicon-erase" aria-hidden="true"/></a>
<a href="{{ url('/profile/' . $item->username) }}" class="btn btn-success btn-xs" title="View user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
<a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
{!! Form::open([
'method'=>'DELETE',
'url' => ['/admin/users', $item->id],
'style' => 'display:inline'
]) !!}
{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" />', array(
'type' => 'submit',
'class' => 'btn btn-danger btn-xs',
'title' => 'Delete user',
'onclick'=>'return confirm("Confirm delete?")'
)) !!}
{!! Form::close() !!}
 <a href="{{ url('/messages/create?u=' . $item->username ) }}"" class="btn-kirim-pesan btn btn-success btn-xs" title="Kirim Pesan"><span class="glyphicon glyphicon-inbox" aria-hidden="true"/></a>
