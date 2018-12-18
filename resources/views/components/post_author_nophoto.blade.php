<div class="author">
    <div class="author-name">{{ HTML::link('profile/'.$row->post_authors->username,$row->post_authors->name) }}</div>
    @if(isset($row->post_authors->role) && ($row->post_authors->role == 'premium' || $row->post_authors->role == 'partner' || $row->post_authors->role == 'admin' || $row->post_authors->role == 'editor'))
    <i class="verified-user"></i>
    @else
    <i class="unverified-user"></i>
    @endif
    <div class="author-profession">{{ get_user_profesi($row->post_author) }}</div>
</div>