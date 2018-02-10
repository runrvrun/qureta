@if(Auth::user()->role=='admin')
{!! Form::open([
'method'=>'DELETE',
'url' => ['/admin/competition_posts', $item->id],
'style' => 'display:inline'
]) !!}
{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
'type' => 'submit',
'class' => 'btn btn-danger btn-xs',
'title' => 'Delete Competition_post',
'onclick'=>'return confirm("Confirm delete?")'
)) !!}
{!! Form::close() !!}
@endif
