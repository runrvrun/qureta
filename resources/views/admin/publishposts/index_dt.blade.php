@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
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

@push('scripts')
<script>
$(function() {
  $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[3,'desc']],
      ajax: '{!! url('/admin/publishposts/data') !!}',
      columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'users.name' },
          { data: 'post_title', name: 'post_title' },
          { data: 'published_at', name: 'published_at' },
          { data: 'published_by', name: 'published_by' },
          { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'}
      ]
  });
});
</script>
@endpush
