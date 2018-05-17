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
                                    <th>No</th><th> Topik </th><th> Jumlah Naskah </th><th> Jumlah View </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; $total =0; $totalview=0; ?>
                                @foreach($categories as $key=>$item)
                                <?php $total += $item->counter; $totalview += $item->viewcounter; ?>
                                <tr>
                                    <td class="pull-right">{{ $categories->firstItem() + $key }}</td><td>{{ HTML::link('/topik/'.$item->category_slug,$item->category_title) }}</td><td class="pull-right">{{ number_format($item->counter,0,',','.') }}</td><td class="pull-right">{{ number_format($item->viewcounter,0,',','.') }}</td>
                                </tr>
                                @endforeach
                            <tfoot><th>&nbsp;</th><th style="text-align: right">Total</th><th class="pull-right">{{ number_format($total,0,',','.') }}</th><th class="pull-right">{{ number_format($totalview,0,',','.') }}</th></tfoot>
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
