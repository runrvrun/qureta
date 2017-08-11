@extends('layouts.admin')


@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
@include('admin.statistics.statistics-menu')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $pagetitle }}</div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th><th> Jenis </th><th> Jumlah </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; $total =0; ?>
                                @foreach($users as $item)
                                <?php $i++; $total += $item->counter; ?>
                                <tr>
                                    <td>{{ $i }}</td><td>{{ $item->user_type }}</td><td>{{ $item->counter }}</td>
                                </tr>
                                @endforeach
                            <tfoot><th colspan="2" style="text-align: right">Total</th><th>{{ $total }}</th></tfoot>
                            </tbody>
                        </table>
                        @if (method_exists($users,'render') && $users->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection