<div class="author">
    @if(strpos($row->user_image,'ttps://') || strpos($row->user_image,'ttp://'))
    <div class="author-image"
         style="background-image: url('{{ $row->user_image }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
    </div>
    @else
    <div class="author-image"
         style="background: url('{{ URL::asset('/uploads/avatar/'.$row->user_image) }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
    </div>
    @endif
    <div class="author-name">{{ HTML::link('profile/'.$row->username,$row->name) }}</div>
    @if(isset($row->role) && ($row->role == 'premium' || $row->role == 'partner' || $row->role == 'admin' || $row->role == 'editor'))
    <i class="verified-user"></i>
    @else
    <i class="unverified-user"></i>
    @endif
    <div class="author-profession">{{ get_user_profesi($row->id) }}</div>
</div>
