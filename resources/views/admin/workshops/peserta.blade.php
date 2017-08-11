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
                <div class="panel-heading"><a href="{{url('admin/workshops')}}">Workshops</a> / Peserta Workshop</div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Nama</th><th> Email </th><th>No. Telepon</th><th>Alamat</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshop as $item)
                                <tr>
                                   
                                    <td>{{ $item->name }}</td>
                                   <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                   <td>{{ $item->address }}</td>
                                     <td>{{ $item->tempat_lahir }}</td>
                                   <td>{{ $item->tgl_lahir }}</td>
                                   <td><a href="{{ url( '/admin/workshops_posts/'.$item->workshop_id.'/'.$item->user_id)}}"><button class="btn btn-xs btn-primary">Lihat File</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (method_exists($workshop,'render') && $workshop->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $workshop->render() !!} </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script>
    $('.btnLike').click(function () {
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
                    console.log(data)
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
                    console.log(data)
                },
                success: function () {
                }
            });
        }
    });
</script>
@endsection