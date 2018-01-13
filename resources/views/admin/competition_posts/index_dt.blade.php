@extends('layouts.admin')

@section('content')
<div class="container">
    <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
    @if (Session::has('flash_message'))
    <div class="alert alert-success alert-dismissible col-md-8" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Naskah Lomba: {{ $competition->competition_title or '' }}</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th> Actions </th>
                                    <th> Vote </th>
                                    <th> Judul </th>
                                    <th> Penulis </th>
                                    <th> Tulisan </th>
                                    <th> View </th>
                                    <th> Kata </th>
                                    <th> Terbit </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
  $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[1,'desc']],
      ajax: '{!! url('/admin/competition_posts/data/'.$competition->id) !!}',
      columns: [
          { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'},
          { data: 'vote', name: 'vote', searchable: false },
          { data: 'post_title', name: 'posts.post_title' },
          { data: 'name', name: 'users.name' },
          { data: 'post_count', name: 'post_count', searchable: false },
          { data: 'view_count', name: 'view_count', searchable: false },
          { data: 'word_count', name: 'word_count', searchable: false },
          { data: 'published_at', name: 'posts.published_at', className: 'nowrap' }
      ]
  });
});
</script>
@endpush
@section('addjs')
<script type="text/javascript">
    $(document).ready(function() {
	    $("#datatable").on("click", ".btnLike", function(){
		   var $this = $(this);
	        $this.toggleClass('active');
	        $this.children("i").toggleClass('active');
	        var postid = $this.data('postid');
	        var followerid = document.getElementById('followerid').value;
	        var token = '{{{ csrf_token() }}}';
	        var data = {"_token": token, "postid": postid, "followerid": followerid};
	        if ($this.hasClass('active')) {
	            $.ajax({
	                url: "/admin/competition_posts/like",
	                type: "POST",
	                data: data,
	                error: function (exception) {
	                    console.log(data);
	                },
	                success: function () {
	                }
	            });
	        } else {
	            $.ajax({
	                url: "/admin/competition_posts/unlike",
	                type: "POST",
	                data: data,
	                error: function (exception) {
	                    console.log(data);
	                },
	                success: function () {
	                }
	            });
	        }
		});
	} );
</script>
@endsection
