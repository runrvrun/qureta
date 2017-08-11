@extends('layouts.admin')


@section('title')
- {{ $pagetitle }}
@endsection

@section('content')
{!! Form::open(['url' => '/admin/statistics/search', 'class' => 'form-horizontal']) !!}
<div class="row">
    <div class="form-group form-inline">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::date('startdate', null, ['class' => 'form-control', 'placeholder'=>'Start date']) !!}
            {!! Form::date('enddate', null, ['class' => 'form-control', 'placeholder'=>'End date']) !!}
            {!! Form::submit('Filter', ['class' => 'btn btn-default']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $pagetitle }}</div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th><th> Topik </th><th> Jumlah Naskah </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; $total =0; ?>
                                @foreach($categories as $item)
                                <?php $i++; $total += $item->counter; ?>
                                <tr>
                                    <td>{{ $i }}</td><td>{{ $item->category_title }}</td><td>{{ $item->counter }}</td>
                                </tr>
                                @endforeach
                            <tfoot><th colspan="2" style="text-align: right">Total</th><th>{{ $total }}</th></tfoot>
                            </tbody>
                        </table>
                        @if (method_exists($categories,'render') && $categories->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $categories->render() !!} </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection