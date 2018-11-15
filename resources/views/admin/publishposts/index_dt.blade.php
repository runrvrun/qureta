@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
          @if (Session::has('flash_message'))
          <div class="alert alert-success alert-dismissible col-md-8" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <p>{!! Session::get('flash_message') !!}</p>
          </div>
          @endif
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Naskah Terbit</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Penulis </th>
                                        <th> Judul </th>
                                        <th> View </th>
                                        <th> Tanggal Terbit </th>
                                        <th> Diterbitkan Oleh </th>
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

@section('addjs')
<script>
function displayNotification() {
  if (Notification.permission == 'granted') {
    navigator.serviceWorker.getRegistration().then(function(reg) {
      reg.showNotification('Hello admin!');
    });
  }
}
displayNotification();
</script>
@endsection

@push('scripts')
<script>
$(function() {
  $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[4,'desc']],
      ajax: '{!! url('/admin/publishposts/data') !!}',
      columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'users.name' },
          { data: 'post_title', name: 'post_title' },
          { data: 'view_count', name: 'view_count' },
          { data: 'published_at', name: 'published_at' },
          { data: 'published_by', name: 'published_by' },
          { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'}
      ],
      fnRowCallback: function( nRow, aData, iDisplayIndex ) {
            $('td:eq(2)', nRow).html( '<a href="/post/' + aData.post_slug + '" target="_blank">' + aData.post_title + '</a>' );
            $('td:eq(1)', nRow).html( '<a href="/profile/' + aData.username + '" target="_blank">' + aData.name + '</a>' );
        },
  });
});
</script>
@endpush
