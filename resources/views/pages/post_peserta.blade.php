@extends('layouts.app')

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
                <div class="panel-heading"></div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Penulis </th><th> Judul </th><th>Tanggal Terbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($competition_posts as $item)
                            @if($item->composts)
                                <tr>
                                <td>{{ $item->composts->post_authors['name'] }}</td>
                                    <td class="judul-post-lomba"><div>{{ HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) }}</div></td>
                                   
                                   <td>{{$item->composts['published_at']}}</td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if (method_exists($competition_posts,'render') && $competition_posts->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $competition_posts->render() !!} </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addjs')

@endsection