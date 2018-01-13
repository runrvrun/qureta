@if (isLikingCompost($item->id))
<a class="btnLike active" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
@else
<a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
@endif
<a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-primary btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
@if(Auth::user()->role='admin')
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
