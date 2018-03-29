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
                <div class="panel-heading">Naskah Workshop</div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Nama Peserta</th><th> Nama File </th><th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshop_posts as $item)
                                <tr>

                                    <td>{{ HTML::link('/profile/'.$item->username,$item->name) }}</td>

                                    <td>{{ $item->original_filename }}</td>
                                    <td><a href="{{ URL::to( 'uploads/tulisan/' . $item->original_filename)  }}" target="_blank"><button class="btn btn-xs btn-primary">Download</button></a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (method_exists($workshop_posts,'render') && $workshop_posts->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $workshop_posts->render() !!} </div>
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
