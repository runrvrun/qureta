@if (isLikingCompost($item->id))
<a class="btnLike active" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
@else
<a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
@endif
