@extends('admin.layouts.admin')
<!-- Tidak dipakai @ extends('layouts.admin')-->

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
                <div class="panel-heading">Naskah Lomba: {{ $competition->competition_title ?? '' }}</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th> &nbsp; </th>
                                    <th> Vote </th>
                                    <th> Judul </th>
                                    <th> Penulis </th>
                                    <th> Tulisan </th>
                                    <th> View </th>
                                    <th> Kata </th>
                                    <th> Terbit </th>
                                    <th> Actions </th>
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
      @if(Auth::user()->role=='admin')
      order: [[1,'desc']],
      @else
      order: [[2,'asc']],
      @endif
      ajax: '{!! url('/admin/competition_posts/data/'.$competition->id) !!}',
      columns: [
          { data: 'star', name: 'star', orderable: false, searchable: false, className: 'nowrap'},
          { data: 'vote', name: 'vote', searchable: false },
          { data: 'post_title', name: 'posts.post_title' },
          { data: 'name', name: 'users.name' },
          { data: 'post_count', name: 'post_count', searchable: false },
          { data: 'view_count', name: 'view_count', searchable: false },
          { data: 'word_count', name: 'word_count', searchable: false },
          { data: 'published_at', name: 'posts.published_at', className: 'nowrap' },
          { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'}
      ],
      fnRowCallback: function( nRow, aData, iDisplayIndex ) {
            @if(Auth::user()->role=='admin')
            $('td:eq(1)', nRow).html( '<a href="#" target="_blank" title="' + aData.voter + '">' + aData.vote + '</a>' );
            @else
            $('td:eq(1)', nRow).html( '' );
            @endif
            $('td:eq(2)', nRow).html( '<a href="/post/' + aData.post_slug + '" target="_blank">' + aData.post_title + '</a>' );
            $('td:eq(3)', nRow).html( '<a href="/profile/' + aData.username + '" target="_blank">' + aData.name + '</a>' );
            $('td:eq(4)', nRow).html( '<a href="/profile/' + aData.username + '" target="_blank">' + aData.post_count + '</a>' );
        },
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
