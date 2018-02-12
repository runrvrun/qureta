@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Shops</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/shops/create') }}" class="btn btn-primary btn-xs" title="Add New Shop"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th> Name </th><th> Price </th><th> Category </th><th> Link </th><th>Actions</th>
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
      ajax: '{!! url('/admin/shops/data/') !!}',
      columns: [
          { data: 'name', name: 'name' },
          { data: 'price', name: 'price'},
          { data: 'category', name: 'category'},
          { data: 'link', name: 'link'},
          { data: 'action', name: 'action', orderable: false, searchable: false, className: 'nowrap'}
      ]
  });
});
</script>
@endpush
